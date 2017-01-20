<?php

namespace Map;

use \Colaborador;
use \ColaboradorQuery;
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
 * This class defines the structure of the 'Colaborador' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ColaboradorTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ColaboradorTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'prueba';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Colaborador';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Colaborador';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Colaborador';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the prueba field
     */
    const COL_PRUEBA = 'Colaborador.prueba';

    /**
     * the column name for the mensaje field
     */
    const COL_MENSAJE = 'Colaborador.mensaje';

    /**
     * the column name for the idColaborador2 field
     */
    const COL_IDCOLABORADOR2 = 'Colaborador.idColaborador2';

    /**
     * the column name for the idusuario field
     */
    const COL_IDUSUARIO = 'Colaborador.idusuario';

    /**
     * the column name for the password field
     */
    const COL_PASSWORD = 'Colaborador.password';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'Colaborador.email';

    /**
     * the column name for the avatar field
     */
    const COL_AVATAR = 'Colaborador.avatar';

    /**
     * the column name for the nombre field
     */
    const COL_NOMBRE = 'Colaborador.nombre';

    /**
     * the column name for the apellidos field
     */
    const COL_APELLIDOS = 'Colaborador.apellidos';

    /**
     * the column name for the fkperfil field
     */
    const COL_FKPERFIL = 'Colaborador.fkperfil';

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
        self::TYPE_PHPNAME       => array('Prueba', 'Mensaje', 'Idcolaborador2', 'Idusuario', 'Password', 'Email', 'Avatar', 'Nombre', 'Apellidos', 'Fkperfil', ),
        self::TYPE_CAMELNAME     => array('prueba', 'mensaje', 'idcolaborador2', 'idusuario', 'password', 'email', 'avatar', 'nombre', 'apellidos', 'fkperfil', ),
        self::TYPE_COLNAME       => array(ColaboradorTableMap::COL_PRUEBA, ColaboradorTableMap::COL_MENSAJE, ColaboradorTableMap::COL_IDCOLABORADOR2, ColaboradorTableMap::COL_IDUSUARIO, ColaboradorTableMap::COL_PASSWORD, ColaboradorTableMap::COL_EMAIL, ColaboradorTableMap::COL_AVATAR, ColaboradorTableMap::COL_NOMBRE, ColaboradorTableMap::COL_APELLIDOS, ColaboradorTableMap::COL_FKPERFIL, ),
        self::TYPE_FIELDNAME     => array('prueba', 'mensaje', 'idColaborador2', 'idusuario', 'password', 'email', 'avatar', 'nombre', 'apellidos', 'fkperfil', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Prueba' => 0, 'Mensaje' => 1, 'Idcolaborador2' => 2, 'Idusuario' => 3, 'Password' => 4, 'Email' => 5, 'Avatar' => 6, 'Nombre' => 7, 'Apellidos' => 8, 'Fkperfil' => 9, ),
        self::TYPE_CAMELNAME     => array('prueba' => 0, 'mensaje' => 1, 'idcolaborador2' => 2, 'idusuario' => 3, 'password' => 4, 'email' => 5, 'avatar' => 6, 'nombre' => 7, 'apellidos' => 8, 'fkperfil' => 9, ),
        self::TYPE_COLNAME       => array(ColaboradorTableMap::COL_PRUEBA => 0, ColaboradorTableMap::COL_MENSAJE => 1, ColaboradorTableMap::COL_IDCOLABORADOR2 => 2, ColaboradorTableMap::COL_IDUSUARIO => 3, ColaboradorTableMap::COL_PASSWORD => 4, ColaboradorTableMap::COL_EMAIL => 5, ColaboradorTableMap::COL_AVATAR => 6, ColaboradorTableMap::COL_NOMBRE => 7, ColaboradorTableMap::COL_APELLIDOS => 8, ColaboradorTableMap::COL_FKPERFIL => 9, ),
        self::TYPE_FIELDNAME     => array('prueba' => 0, 'mensaje' => 1, 'idColaborador2' => 2, 'idusuario' => 3, 'password' => 4, 'email' => 5, 'avatar' => 6, 'nombre' => 7, 'apellidos' => 8, 'fkperfil' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('Colaborador');
        $this->setPhpName('Colaborador');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Colaborador');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('prueba', 'Prueba', 'BIGINT', true, null, null);
        $this->addColumn('mensaje', 'Mensaje', 'INTEGER', false, null, null);
        $this->addPrimaryKey('idColaborador2', 'Idcolaborador2', 'VARCHAR', true, 200, null);
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
     * @param \Colaborador $obj A \Colaborador object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getIdcolaborador2() || is_scalar($obj->getIdcolaborador2()) || is_callable([$obj->getIdcolaborador2(), '__toString']) ? (string) $obj->getIdcolaborador2() : $obj->getIdcolaborador2()), (null === $obj->getIdusuario() || is_scalar($obj->getIdusuario()) || is_callable([$obj->getIdusuario(), '__toString']) ? (string) $obj->getIdusuario() : $obj->getIdusuario())]);
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
     * @param mixed $value A \Colaborador object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Colaborador) {
                $key = serialize([(null === $value->getIdcolaborador2() || is_scalar($value->getIdcolaborador2()) || is_callable([$value->getIdcolaborador2(), '__toString']) ? (string) $value->getIdcolaborador2() : $value->getIdcolaborador2()), (null === $value->getIdusuario() || is_scalar($value->getIdusuario()) || is_callable([$value->getIdusuario(), '__toString']) ? (string) $value->getIdusuario() : $value->getIdusuario())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Colaborador object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Idcolaborador2', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Idcolaborador2', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Idcolaborador2', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Idcolaborador2', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Idcolaborador2', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Idcolaborador2', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 2 + $offset
                : self::translateFieldName('Idcolaborador2', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 3 + $offset
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
        return $withPrefix ? ColaboradorTableMap::CLASS_DEFAULT : ColaboradorTableMap::OM_CLASS;
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
     * @return array           (Colaborador object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ColaboradorTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ColaboradorTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ColaboradorTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ColaboradorTableMap::OM_CLASS;
            /** @var Colaborador $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ColaboradorTableMap::addInstanceToPool($obj, $key);
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
            $key = ColaboradorTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ColaboradorTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Colaborador $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ColaboradorTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ColaboradorTableMap::COL_PRUEBA);
            $criteria->addSelectColumn(ColaboradorTableMap::COL_MENSAJE);
            $criteria->addSelectColumn(ColaboradorTableMap::COL_IDCOLABORADOR2);
            $criteria->addSelectColumn(ColaboradorTableMap::COL_IDUSUARIO);
            $criteria->addSelectColumn(ColaboradorTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(ColaboradorTableMap::COL_EMAIL);
            $criteria->addSelectColumn(ColaboradorTableMap::COL_AVATAR);
            $criteria->addSelectColumn(ColaboradorTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(ColaboradorTableMap::COL_APELLIDOS);
            $criteria->addSelectColumn(ColaboradorTableMap::COL_FKPERFIL);
        } else {
            $criteria->addSelectColumn($alias . '.prueba');
            $criteria->addSelectColumn($alias . '.mensaje');
            $criteria->addSelectColumn($alias . '.idColaborador2');
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
        return Propel::getServiceContainer()->getDatabaseMap(ColaboradorTableMap::DATABASE_NAME)->getTable(ColaboradorTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ColaboradorTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ColaboradorTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ColaboradorTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Colaborador or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Colaborador object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ColaboradorTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Colaborador) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ColaboradorTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(ColaboradorTableMap::COL_IDCOLABORADOR2, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(ColaboradorTableMap::COL_IDUSUARIO, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = ColaboradorQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ColaboradorTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ColaboradorTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Colaborador table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ColaboradorQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Colaborador or Criteria object.
     *
     * @param mixed               $criteria Criteria or Colaborador object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ColaboradorTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Colaborador object
        }


        // Set the correct dbName
        $query = ColaboradorQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ColaboradorTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ColaboradorTableMap::buildTableMap();
