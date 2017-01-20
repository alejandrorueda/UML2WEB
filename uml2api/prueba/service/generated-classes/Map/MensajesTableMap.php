<?php

namespace Map;

use \Mensajes;
use \MensajesQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'Mensajes' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class MensajesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.MensajesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'prueba';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Mensajes';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Mensajes';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Mensajes';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the idMensajes field
     */
    const COL_IDMENSAJES = 'Mensajes.idMensajes';

    /**
     * the column name for the asunto field
     */
    const COL_ASUNTO = 'Mensajes.asunto';

    /**
     * the column name for the descripcion field
     */
    const COL_DESCRIPCION = 'Mensajes.descripcion';

    /**
     * the column name for the fkviaje field
     */
    const COL_FKVIAJE = 'Mensajes.fkviaje';

    /**
     * the column name for the fkpadre field
     */
    const COL_FKPADRE = 'Mensajes.fkpadre';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Idmensajes', 'Asunto', 'Descripcion', 'Fkviaje', 'Fkpadre', ),
        self::TYPE_CAMELNAME     => array('idmensajes', 'asunto', 'descripcion', 'fkviaje', 'fkpadre', ),
        self::TYPE_COLNAME       => array(MensajesTableMap::COL_IDMENSAJES, MensajesTableMap::COL_ASUNTO, MensajesTableMap::COL_DESCRIPCION, MensajesTableMap::COL_FKVIAJE, MensajesTableMap::COL_FKPADRE, ),
        self::TYPE_FIELDNAME     => array('idMensajes', 'asunto', 'descripcion', 'fkviaje', 'fkpadre', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Idmensajes' => 0, 'Asunto' => 1, 'Descripcion' => 2, 'Fkviaje' => 3, 'Fkpadre' => 4, ),
        self::TYPE_CAMELNAME     => array('idmensajes' => 0, 'asunto' => 1, 'descripcion' => 2, 'fkviaje' => 3, 'fkpadre' => 4, ),
        self::TYPE_COLNAME       => array(MensajesTableMap::COL_IDMENSAJES => 0, MensajesTableMap::COL_ASUNTO => 1, MensajesTableMap::COL_DESCRIPCION => 2, MensajesTableMap::COL_FKVIAJE => 3, MensajesTableMap::COL_FKPADRE => 4, ),
        self::TYPE_FIELDNAME     => array('idMensajes' => 0, 'asunto' => 1, 'descripcion' => 2, 'fkviaje' => 3, 'fkpadre' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('Mensajes');
        $this->setPhpName('Mensajes');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Mensajes');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idMensajes', 'Idmensajes', 'INTEGER', true, null, null);
        $this->addColumn('asunto', 'Asunto', 'VARCHAR', true, 150, null);
        $this->addColumn('descripcion', 'Descripcion', 'LONGVARCHAR', true, null, null);
        $this->addForeignKey('fkviaje', 'Fkviaje', 'INTEGER', 'Viaje', 'idViaje', false, null, null);
        $this->addForeignKey('fkpadre', 'Fkpadre', 'INTEGER', 'Mensajes', 'idMensajes', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Viaje', '\\Viaje', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fkviaje',
    1 => ':idViaje',
  ),
), null, null, null, false);
        $this->addRelation('MensajesRelatedByFkpadre', '\\Mensajes', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fkpadre',
    1 => ':idMensajes',
  ),
), null, null, null, false);
        $this->addRelation('MensajesRelatedByIdmensajes', '\\Mensajes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fkpadre',
    1 => ':idMensajes',
  ),
), null, null, 'MensajessRelatedByIdmensajes', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idmensajes', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idmensajes', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idmensajes', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idmensajes', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idmensajes', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idmensajes', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Idmensajes', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }
    
    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? MensajesTableMap::CLASS_DEFAULT : MensajesTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Mensajes object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = MensajesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MensajesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MensajesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MensajesTableMap::OM_CLASS;
            /** @var Mensajes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MensajesTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();
    
        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = MensajesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MensajesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Mensajes $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MensajesTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(MensajesTableMap::COL_IDMENSAJES);
            $criteria->addSelectColumn(MensajesTableMap::COL_ASUNTO);
            $criteria->addSelectColumn(MensajesTableMap::COL_DESCRIPCION);
            $criteria->addSelectColumn(MensajesTableMap::COL_FKVIAJE);
            $criteria->addSelectColumn(MensajesTableMap::COL_FKPADRE);
        } else {
            $criteria->addSelectColumn($alias . '.idMensajes');
            $criteria->addSelectColumn($alias . '.asunto');
            $criteria->addSelectColumn($alias . '.descripcion');
            $criteria->addSelectColumn($alias . '.fkviaje');
            $criteria->addSelectColumn($alias . '.fkpadre');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(MensajesTableMap::DATABASE_NAME)->getTable(MensajesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(MensajesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(MensajesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new MensajesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Mensajes or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Mensajes object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MensajesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Mensajes) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MensajesTableMap::DATABASE_NAME);
            $criteria->add(MensajesTableMap::COL_IDMENSAJES, (array) $values, Criteria::IN);
        }

        $query = MensajesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MensajesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MensajesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Mensajes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return MensajesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Mensajes or Criteria object.
     *
     * @param mixed               $criteria Criteria or Mensajes object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MensajesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Mensajes object
        }

        if ($criteria->containsKey(MensajesTableMap::COL_IDMENSAJES) && $criteria->keyContainsValue(MensajesTableMap::COL_IDMENSAJES) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MensajesTableMap::COL_IDMENSAJES.')');
        }


        // Set the correct dbName
        $query = MensajesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // MensajesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
MensajesTableMap::buildTableMap();
