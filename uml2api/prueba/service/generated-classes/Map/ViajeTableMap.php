<?php

namespace Map;

use \Viaje;
use \ViajeQuery;
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
 * This class defines the structure of the 'Viaje' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ViajeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ViajeTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'prueba';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Viaje';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Viaje';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Viaje';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the idViaje field
     */
    const COL_IDVIAJE = 'Viaje.idViaje';

    /**
     * the column name for the transporte field
     */
    const COL_TRANSPORTE = 'Viaje.transporte';

    /**
     * the column name for the nombre field
     */
    const COL_NOMBRE = 'Viaje.nombre';

    /**
     * the column name for the destino field
     */
    const COL_DESTINO = 'Viaje.destino';

    /**
     * the column name for the etiquetas field
     */
    const COL_ETIQUETAS = 'Viaje.etiquetas';

    /**
     * the column name for the hospedaje field
     */
    const COL_HOSPEDAJE = 'Viaje.hospedaje';

    /**
     * the column name for the fechainicio field
     */
    const COL_FECHAINICIO = 'Viaje.fechainicio';

    /**
     * the column name for the fechafinal field
     */
    const COL_FECHAFINAL = 'Viaje.fechafinal';

    /**
     * the column name for the informacion field
     */
    const COL_INFORMACION = 'Viaje.informacion';

    /**
     * the column name for the imagenes field
     */
    const COL_IMAGENES = 'Viaje.imagenes';

    /**
     * the column name for the precio field
     */
    const COL_PRECIO = 'Viaje.precio';

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
        self::TYPE_PHPNAME       => array('Idviaje', 'Transporte', 'Nombre', 'Destino', 'Etiquetas', 'Hospedaje', 'Fechainicio', 'Fechafinal', 'Informacion', 'Imagenes', 'Precio', ),
        self::TYPE_CAMELNAME     => array('idviaje', 'transporte', 'nombre', 'destino', 'etiquetas', 'hospedaje', 'fechainicio', 'fechafinal', 'informacion', 'imagenes', 'precio', ),
        self::TYPE_COLNAME       => array(ViajeTableMap::COL_IDVIAJE, ViajeTableMap::COL_TRANSPORTE, ViajeTableMap::COL_NOMBRE, ViajeTableMap::COL_DESTINO, ViajeTableMap::COL_ETIQUETAS, ViajeTableMap::COL_HOSPEDAJE, ViajeTableMap::COL_FECHAINICIO, ViajeTableMap::COL_FECHAFINAL, ViajeTableMap::COL_INFORMACION, ViajeTableMap::COL_IMAGENES, ViajeTableMap::COL_PRECIO, ),
        self::TYPE_FIELDNAME     => array('idViaje', 'transporte', 'nombre', 'destino', 'etiquetas', 'hospedaje', 'fechainicio', 'fechafinal', 'informacion', 'imagenes', 'precio', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Idviaje' => 0, 'Transporte' => 1, 'Nombre' => 2, 'Destino' => 3, 'Etiquetas' => 4, 'Hospedaje' => 5, 'Fechainicio' => 6, 'Fechafinal' => 7, 'Informacion' => 8, 'Imagenes' => 9, 'Precio' => 10, ),
        self::TYPE_CAMELNAME     => array('idviaje' => 0, 'transporte' => 1, 'nombre' => 2, 'destino' => 3, 'etiquetas' => 4, 'hospedaje' => 5, 'fechainicio' => 6, 'fechafinal' => 7, 'informacion' => 8, 'imagenes' => 9, 'precio' => 10, ),
        self::TYPE_COLNAME       => array(ViajeTableMap::COL_IDVIAJE => 0, ViajeTableMap::COL_TRANSPORTE => 1, ViajeTableMap::COL_NOMBRE => 2, ViajeTableMap::COL_DESTINO => 3, ViajeTableMap::COL_ETIQUETAS => 4, ViajeTableMap::COL_HOSPEDAJE => 5, ViajeTableMap::COL_FECHAINICIO => 6, ViajeTableMap::COL_FECHAFINAL => 7, ViajeTableMap::COL_INFORMACION => 8, ViajeTableMap::COL_IMAGENES => 9, ViajeTableMap::COL_PRECIO => 10, ),
        self::TYPE_FIELDNAME     => array('idViaje' => 0, 'transporte' => 1, 'nombre' => 2, 'destino' => 3, 'etiquetas' => 4, 'hospedaje' => 5, 'fechainicio' => 6, 'fechafinal' => 7, 'informacion' => 8, 'imagenes' => 9, 'precio' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
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
        $this->setName('Viaje');
        $this->setPhpName('Viaje');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Viaje');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idViaje', 'Idviaje', 'INTEGER', true, null, null);
        $this->addColumn('transporte', 'Transporte', 'LONGVARCHAR', true, null, null);
        $this->addColumn('nombre', 'Nombre', 'VARCHAR', true, 1, null);
        $this->addColumn('destino', 'Destino', 'VARCHAR', true, 100, null);
        $this->addColumn('etiquetas', 'Etiquetas', 'VARCHAR', true, 1, null);
        $this->addColumn('hospedaje', 'Hospedaje', 'LONGVARCHAR', true, null, null);
        $this->addColumn('fechainicio', 'Fechainicio', 'DATE', true, null, null);
        $this->addColumn('fechafinal', 'Fechafinal', 'VARCHAR', true, 1, null);
        $this->addColumn('informacion', 'Informacion', 'LONGVARCHAR', true, null, null);
        $this->addColumn('imagenes', 'Imagenes', 'VARCHAR', true, 1, null);
        $this->addColumn('precio', 'Precio', 'DOUBLE', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Viajes', '\\Viajes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idViaje',
    1 => ':idViaje',
  ),
), null, null, 'Viajess', false);
        $this->addRelation('Mensajes', '\\Mensajes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fkviaje',
    1 => ':idViaje',
  ),
), null, null, 'Mensajess', false);
        $this->addRelation('GrupoViaje', '\\GrupoViaje', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idViaje',
    1 => ':idViaje',
  ),
), null, null, 'GrupoViajes', false);
        $this->addRelation('Usuario', '\\Usuario', RelationMap::MANY_TO_MANY, array(), null, null, 'Usuarios');
        $this->addRelation('Grupo', '\\Grupo', RelationMap::MANY_TO_MANY, array(), null, null, 'Grupos');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idviaje', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idviaje', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idviaje', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idviaje', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idviaje', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idviaje', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Idviaje', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ViajeTableMap::CLASS_DEFAULT : ViajeTableMap::OM_CLASS;
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
     * @return array           (Viaje object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ViajeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ViajeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ViajeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ViajeTableMap::OM_CLASS;
            /** @var Viaje $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ViajeTableMap::addInstanceToPool($obj, $key);
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
            $key = ViajeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ViajeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Viaje $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ViajeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ViajeTableMap::COL_IDVIAJE);
            $criteria->addSelectColumn(ViajeTableMap::COL_TRANSPORTE);
            $criteria->addSelectColumn(ViajeTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(ViajeTableMap::COL_DESTINO);
            $criteria->addSelectColumn(ViajeTableMap::COL_ETIQUETAS);
            $criteria->addSelectColumn(ViajeTableMap::COL_HOSPEDAJE);
            $criteria->addSelectColumn(ViajeTableMap::COL_FECHAINICIO);
            $criteria->addSelectColumn(ViajeTableMap::COL_FECHAFINAL);
            $criteria->addSelectColumn(ViajeTableMap::COL_INFORMACION);
            $criteria->addSelectColumn(ViajeTableMap::COL_IMAGENES);
            $criteria->addSelectColumn(ViajeTableMap::COL_PRECIO);
        } else {
            $criteria->addSelectColumn($alias . '.idViaje');
            $criteria->addSelectColumn($alias . '.transporte');
            $criteria->addSelectColumn($alias . '.nombre');
            $criteria->addSelectColumn($alias . '.destino');
            $criteria->addSelectColumn($alias . '.etiquetas');
            $criteria->addSelectColumn($alias . '.hospedaje');
            $criteria->addSelectColumn($alias . '.fechainicio');
            $criteria->addSelectColumn($alias . '.fechafinal');
            $criteria->addSelectColumn($alias . '.informacion');
            $criteria->addSelectColumn($alias . '.imagenes');
            $criteria->addSelectColumn($alias . '.precio');
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
        return Propel::getServiceContainer()->getDatabaseMap(ViajeTableMap::DATABASE_NAME)->getTable(ViajeTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ViajeTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ViajeTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ViajeTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Viaje or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Viaje object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ViajeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Viaje) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ViajeTableMap::DATABASE_NAME);
            $criteria->add(ViajeTableMap::COL_IDVIAJE, (array) $values, Criteria::IN);
        }

        $query = ViajeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ViajeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ViajeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Viaje table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ViajeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Viaje or Criteria object.
     *
     * @param mixed               $criteria Criteria or Viaje object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ViajeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Viaje object
        }

        if ($criteria->containsKey(ViajeTableMap::COL_IDVIAJE) && $criteria->keyContainsValue(ViajeTableMap::COL_IDVIAJE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ViajeTableMap::COL_IDVIAJE.')');
        }


        // Set the correct dbName
        $query = ViajeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ViajeTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ViajeTableMap::buildTableMap();
