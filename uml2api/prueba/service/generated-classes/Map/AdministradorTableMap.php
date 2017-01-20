<?php

namespace Map;

use \Administrador;
use \AdministradorQuery;
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
 * This class defines the structure of the 'Administrador' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AdministradorTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.AdministradorTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'prueba';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Administrador';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Administrador';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Administrador';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the idAdministrador field
     */
    const COL_IDADMINISTRADOR = 'Administrador.idAdministrador';

    /**
     * the column name for the idusuario field
     */
    const COL_IDUSUARIO = 'Administrador.idusuario';

    /**
     * the column name for the password field
     */
    const COL_PASSWORD = 'Administrador.password';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'Administrador.email';

    /**
     * the column name for the avatar field
     */
    const COL_AVATAR = 'Administrador.avatar';

    /**
     * the column name for the nombre field
     */
    const COL_NOMBRE = 'Administrador.nombre';

    /**
     * the column name for the apellidos field
     */
    const COL_APELLIDOS = 'Administrador.apellidos';

    /**
     * the column name for the fkperfil field
     */
    const COL_FKPERFIL = 'Administrador.fkperfil';

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
        self::TYPE_PHPNAME       => array('Idadministrador', 'Idusuario', 'Password', 'Email', 'Avatar', 'Nombre', 'Apellidos', 'Fkperfil', ),
        self::TYPE_CAMELNAME     => array('idadministrador', 'idusuario', 'password', 'email', 'avatar', 'nombre', 'apellidos', 'fkperfil', ),
        self::TYPE_COLNAME       => array(AdministradorTableMap::COL_IDADMINISTRADOR, AdministradorTableMap::COL_IDUSUARIO, AdministradorTableMap::COL_PASSWORD, AdministradorTableMap::COL_EMAIL, AdministradorTableMap::COL_AVATAR, AdministradorTableMap::COL_NOMBRE, AdministradorTableMap::COL_APELLIDOS, AdministradorTableMap::COL_FKPERFIL, ),
        self::TYPE_FIELDNAME     => array('idAdministrador', 'idusuario', 'password', 'email', 'avatar', 'nombre', 'apellidos', 'fkperfil', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Idadministrador' => 0, 'Idusuario' => 1, 'Password' => 2, 'Email' => 3, 'Avatar' => 4, 'Nombre' => 5, 'Apellidos' => 6, 'Fkperfil' => 7, ),
        self::TYPE_CAMELNAME     => array('idadministrador' => 0, 'idusuario' => 1, 'password' => 2, 'email' => 3, 'avatar' => 4, 'nombre' => 5, 'apellidos' => 6, 'fkperfil' => 7, ),
        self::TYPE_COLNAME       => array(AdministradorTableMap::COL_IDADMINISTRADOR => 0, AdministradorTableMap::COL_IDUSUARIO => 1, AdministradorTableMap::COL_PASSWORD => 2, AdministradorTableMap::COL_EMAIL => 3, AdministradorTableMap::COL_AVATAR => 4, AdministradorTableMap::COL_NOMBRE => 5, AdministradorTableMap::COL_APELLIDOS => 6, AdministradorTableMap::COL_FKPERFIL => 7, ),
        self::TYPE_FIELDNAME     => array('idAdministrador' => 0, 'idusuario' => 1, 'password' => 2, 'email' => 3, 'avatar' => 4, 'nombre' => 5, 'apellidos' => 6, 'fkperfil' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('Administrador');
        $this->setPhpName('Administrador');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Administrador');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idAdministrador', 'Idadministrador', 'INTEGER', true, null, null);
        $this->addForeignPrimaryKey('idusuario', 'Idusuario', 'VARCHAR' , 'Usuario', 'idusuario', true, 50, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 50, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 1, null);
        $this->addColumn('avatar', 'Avatar', 'VARCHAR', true, 255, null);
        $this->addColumn('nombre', 'Nombre', 'VARCHAR', true, 50, null);
        $this->addColumn('apellidos', 'Apellidos', 'VARCHAR', true, 100, null);
        $this->addForeignKey('fkperfil', 'Fkperfil', 'INTEGER', 'Perfil', 'idPerfil', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Usuario', '\\Usuario', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idusuario',
    1 => ':idusuario',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Perfil', '\\Perfil', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fkperfil',
    1 => ':idPerfil',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'concrete_inheritance' => array('extends' => 'Usuario', 'descendant_column' => 'descendant_class', 'copy_data_to_parent' => 'true', 'copy_data_to_child' => 'false', 'schema' => '', 'exclude_behaviors' => '', ),
        );
    } // getBehaviors()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Administrador $obj A \Administrador object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getIdadministrador() || is_scalar($obj->getIdadministrador()) || is_callable([$obj->getIdadministrador(), '__toString']) ? (string) $obj->getIdadministrador() : $obj->getIdadministrador()), (null === $obj->getIdusuario() || is_scalar($obj->getIdusuario()) || is_callable([$obj->getIdusuario(), '__toString']) ? (string) $obj->getIdusuario() : $obj->getIdusuario())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Administrador object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Administrador) {
                $key = serialize([(null === $value->getIdadministrador() || is_scalar($value->getIdadministrador()) || is_callable([$value->getIdadministrador(), '__toString']) ? (string) $value->getIdadministrador() : $value->getIdadministrador()), (null === $value->getIdusuario() || is_scalar($value->getIdusuario()) || is_callable([$value->getIdusuario(), '__toString']) ? (string) $value->getIdusuario() : $value->getIdusuario())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Administrador object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idadministrador', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idadministrador', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idadministrador', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idadministrador', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idadministrador', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idadministrador', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];
            
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Idadministrador', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? AdministradorTableMap::CLASS_DEFAULT : AdministradorTableMap::OM_CLASS;
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
     * @return array           (Administrador object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AdministradorTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AdministradorTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AdministradorTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AdministradorTableMap::OM_CLASS;
            /** @var Administrador $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AdministradorTableMap::addInstanceToPool($obj, $key);
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
            $key = AdministradorTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AdministradorTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Administrador $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AdministradorTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AdministradorTableMap::COL_IDADMINISTRADOR);
            $criteria->addSelectColumn(AdministradorTableMap::COL_IDUSUARIO);
            $criteria->addSelectColumn(AdministradorTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(AdministradorTableMap::COL_EMAIL);
            $criteria->addSelectColumn(AdministradorTableMap::COL_AVATAR);
            $criteria->addSelectColumn(AdministradorTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(AdministradorTableMap::COL_APELLIDOS);
            $criteria->addSelectColumn(AdministradorTableMap::COL_FKPERFIL);
        } else {
            $criteria->addSelectColumn($alias . '.idAdministrador');
            $criteria->addSelectColumn($alias . '.idusuario');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.avatar');
            $criteria->addSelectColumn($alias . '.nombre');
            $criteria->addSelectColumn($alias . '.apellidos');
            $criteria->addSelectColumn($alias . '.fkperfil');
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
        return Propel::getServiceContainer()->getDatabaseMap(AdministradorTableMap::DATABASE_NAME)->getTable(AdministradorTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AdministradorTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AdministradorTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AdministradorTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Administrador or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Administrador object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AdministradorTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Administrador) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AdministradorTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(AdministradorTableMap::COL_IDADMINISTRADOR, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(AdministradorTableMap::COL_IDUSUARIO, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = AdministradorQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AdministradorTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AdministradorTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Administrador table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AdministradorQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Administrador or Criteria object.
     *
     * @param mixed               $criteria Criteria or Administrador object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdministradorTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Administrador object
        }

        if ($criteria->containsKey(AdministradorTableMap::COL_IDADMINISTRADOR) && $criteria->keyContainsValue(AdministradorTableMap::COL_IDADMINISTRADOR) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AdministradorTableMap::COL_IDADMINISTRADOR.')');
        }


        // Set the correct dbName
        $query = AdministradorQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AdministradorTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AdministradorTableMap::buildTableMap();
