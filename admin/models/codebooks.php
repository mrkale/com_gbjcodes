<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj. All rights reserved.
 * @license    GNU General Public License version 2 or later. See LICENSE.txt, LICENSE.php.
 * @since      3.7
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Methods handling list of codebooks.
 *
 * @since  3.7
 */
class GbjcodesModelCodebooks extends GbjSeedModelList
{
	/**
	 * The object with statistics query for codes
	 *
	 * @var  object
	 */
	protected $statQueryCodes;

	/**
	 * Method to set the default sorting parameters
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$this->setFilterState('codes', 'uint');
		parent::populateState($ordering, $direction);
	}

	/**
	 * Retrieve list of records from database.
	 *
	 * @return  object  The query for systems.
	 */
	protected function getListQuery()
	{
		$app = JFactory::getApplication();
		$db = $this->getDbo();
		$query = parent::getListQuery();

		// Filter by existing code tables
		if ($app->isClient('site'))
		{
			$query->where($db->quoteName('codes_total') . ' IS NOT NULL');
		}

		// Filter by Codes
		$this->setFilterQuerySome('codes', $query);

		return $query;
	}

	/**
	 * Extend and amend input query with sub queries, etc.
	 *
	 * @param   object  $query       Query to be extended inserted by reference.
	 *
	 * @return  void  The extended query for chaining.
	 */
	protected function extendQuery($query)
	{
		// Extend query with statistics of codes
		$this->getStatQueryCodes();

		if (is_object($this->statQueryCodes))
		{
			// Add published codes
			$query
				->select('COALESCE(sc.codes, 0) AS codes')
				->leftJoin('(' . $this->statQueryCodes . ') sc ON sc.id = a.id AND sc.state = ' . Helper::COMMON_STATE_PUBLISHED);

			// Add total codes. Allow null value for not existing code table.
			$query
				->select('tc.codes AS codes_total')
				->leftJoin('(' . $this->statQueryCodes . ') tc ON tc.id = a.id AND tc.state = ' . Helper::COMMON_STATE_TOTAL);
		}

		return parent::extendQuery($query);
	}

	/**
	 * Retrieve statistics for codes of code books.
	 *
	 * @return  object  The query for statistics
	 */
	protected function getStatQueryCodes()
	{
		if (is_object($this->statQueryCodes))
		{
			return $this->statQueryCodes;
		}

		$tableName = $this->getTable()->getTableName();
		$db	= $this->getDbo();

		// List of all code tables
		$query = $db->getQuery(true)
			->select('a.id, b.table_name')
			->from($db->quoteName($tableName, 'a'))
			->innerJoin("(SELECT table_name FROM information_schema.tables) AS b ON b.table_name = CONCAT('"
				. Helper::getTableName("", true) . "', a.alias)"
			);
		$db->setQuery($query);

		try
		{
			$codeTables = $db->loadObjectList();
		}
		catch (Exception $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');

			return null;
		}

		// Compose subquery for statistics
		foreach ($codeTables as $i => $table)
		{
			$query
				->clear()
				->select($table->id . ' AS id')
				->select('state')
				->select('COUNT(*) AS codes')
				->from($table->table_name)
				->group('state');

			if ($i)
			{
				$this->statQueryCodes->union(clone $query);
			}
			else
			{
				$this->statQueryCodes = clone $query;
			}

			// Add subquery for total
			$query
				->clear()
				->select($table->id . ' AS id')
				->select(Helper::COMMON_STATE_TOTAL . ' AS state')
				->select('COUNT(*) AS codes')
				->from($table->table_name);
			$this->statQueryCodes->union(clone $query);
		}

		return $this->statQueryCodes;
	}
}
