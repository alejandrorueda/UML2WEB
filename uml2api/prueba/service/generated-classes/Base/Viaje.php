<?php

namespace Base;

use \Grupo as ChildGrupo;
use \GrupoQuery as ChildGrupoQuery;
use \GrupoViaje as ChildGrupoViaje;
use \GrupoViajeQuery as ChildGrupoViajeQuery;
use \Mensajes as ChildMensajes;
use \MensajesQuery as ChildMensajesQuery;
use \Usuario as ChildUsuario;
use \UsuarioQuery as ChildUsuarioQuery;
use \Viaje as ChildViaje;
use \ViajeQuery as ChildViajeQuery;
use \Viajes as ChildViajes;
use \ViajesQuery as ChildViajesQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\GrupoViajeTableMap;
use Map\MensajesTableMap;
use Map\ViajeTableMap;
use Map\ViajesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'Viaje' table.
 *
 * 
 *
 * @package    propel.generator..Base
 */
abstract class Viaje implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ViajeTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the idviaje field.
     * 
     * @var        int
     */
    protected $idviaje;

    /**
     * The value for the transporte field.
     * 
     * @var        string
     */
    protected $transporte;

    /**
     * The value for the nombre field.
     * 
     * @var        string
     */
    protected $nombre;

    /**
     * The value for the destino field.
     * 
     * @var        string
     */
    protected $destino;

    /**
     * The value for the etiquetas field.
     * 
     * @var        string
     */
    protected $etiquetas;

    /**
     * The value for the hospedaje field.
     * 
     * @var        string
     */
    protected $hospedaje;

    /**
     * The value for the fechainicio field.
     * 
     * @var        DateTime
     */
    protected $fechainicio;

    /**
     * The value for the fechafinal field.
     * 
     * @var        string
     */
    protected $fechafinal;

    /**
     * The value for the informacion field.
     * 
     * @var        string
     */
    protected $informacion;

    /**
     * The value for the imagenes field.
     * 
     * @var        string
     */
    protected $imagenes;

    /**
     * The value for the precio field.
     * 
     * @var        double
     */
    protected $precio;

    /**
     * @var        ObjectCollection|ChildViajes[] Collection to store aggregation of ChildViajes objects.
     */
    protected $collViajess;
    protected $collViajessPartial;

    /**
     * @var        ObjectCollection|ChildMensajes[] Collection to store aggregation of ChildMensajes objects.
     */
    protected $collMensajess;
    protected $collMensajessPartial;

    /**
     * @var        ObjectCollection|ChildGrupoViaje[] Collection to store aggregation of ChildGrupoViaje objects.
     */
    protected $collGrupoViajes;
    protected $collGrupoViajesPartial;

    /**
     * @var        ObjectCollection|ChildUsuario[] Cross Collection to store aggregation of ChildUsuario objects.
     */
    protected $collUsuarios;

    /**
     * @var bool
     */
    protected $collUsuariosPartial;

    /**
     * @var        ObjectCollection|ChildGrupo[] Cross Collection to store aggregation of ChildGrupo objects.
     */
    protected $collGrupos;

    /**
     * @var bool
     */
    protected $collGruposPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUsuario[]
     */
    protected $usuariosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGrupo[]
     */
    protected $gruposScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildViajes[]
     */
    protected $viajessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMensajes[]
     */
    protected $mensajessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGrupoViaje[]
     */
    protected $grupoViajesScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Viaje object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Viaje</code> instance.  If
     * <code>obj</code> is an instance of <code>Viaje</code>, delegates to
     * <code>equals(Viaje)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Viaje The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));
        
        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }
        
        return $propertyNames;
    }

    /**
     * Get the [idviaje] column value.
     * 
     * @return int
     */
    public function getIdviaje()
    {
        return $this->idviaje;
    }

    /**
     * Get the [transporte] column value.
     * 
     * @return string
     */
    public function getTransporte()
    {
        return $this->transporte;
    }

    /**
     * Get the [nombre] column value.
     * 
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the [destino] column value.
     * 
     * @return string
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Get the [etiquetas] column value.
     * 
     * @return string
     */
    public function getEtiquetas()
    {
        return $this->etiquetas;
    }

    /**
     * Get the [hospedaje] column value.
     * 
     * @return string
     */
    public function getHospedaje()
    {
        return $this->hospedaje;
    }

    /**
     * Get the [optionally formatted] temporal [fechainicio] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechainicio($format = NULL)
    {
        if ($format === null) {
            return $this->fechainicio;
        } else {
            return $this->fechainicio instanceof \DateTimeInterface ? $this->fechainicio->format($format) : null;
        }
    }

    /**
     * Get the [fechafinal] column value.
     * 
     * @return string
     */
    public function getFechafinal()
    {
        return $this->fechafinal;
    }

    /**
     * Get the [informacion] column value.
     * 
     * @return string
     */
    public function getInformacion()
    {
        return $this->informacion;
    }

    /**
     * Get the [imagenes] column value.
     * 
     * @return string
     */
    public function getImagenes()
    {
        return $this->imagenes;
    }

    /**
     * Get the [precio] column value.
     * 
     * @return double
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of [idviaje] column.
     * 
     * @param int $v new value
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function setIdviaje($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idviaje !== $v) {
            $this->idviaje = $v;
            $this->modifiedColumns[ViajeTableMap::COL_IDVIAJE] = true;
        }

        return $this;
    } // setIdviaje()

    /**
     * Set the value of [transporte] column.
     * 
     * @param string $v new value
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function setTransporte($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->transporte !== $v) {
            $this->transporte = $v;
            $this->modifiedColumns[ViajeTableMap::COL_TRANSPORTE] = true;
        }

        return $this;
    } // setTransporte()

    /**
     * Set the value of [nombre] column.
     * 
     * @param string $v new value
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function setNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre !== $v) {
            $this->nombre = $v;
            $this->modifiedColumns[ViajeTableMap::COL_NOMBRE] = true;
        }

        return $this;
    } // setNombre()

    /**
     * Set the value of [destino] column.
     * 
     * @param string $v new value
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function setDestino($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->destino !== $v) {
            $this->destino = $v;
            $this->modifiedColumns[ViajeTableMap::COL_DESTINO] = true;
        }

        return $this;
    } // setDestino()

    /**
     * Set the value of [etiquetas] column.
     * 
     * @param string $v new value
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function setEtiquetas($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->etiquetas !== $v) {
            $this->etiquetas = $v;
            $this->modifiedColumns[ViajeTableMap::COL_ETIQUETAS] = true;
        }

        return $this;
    } // setEtiquetas()

    /**
     * Set the value of [hospedaje] column.
     * 
     * @param string $v new value
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function setHospedaje($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->hospedaje !== $v) {
            $this->hospedaje = $v;
            $this->modifiedColumns[ViajeTableMap::COL_HOSPEDAJE] = true;
        }

        return $this;
    } // setHospedaje()

    /**
     * Sets the value of [fechainicio] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function setFechainicio($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fechainicio !== null || $dt !== null) {
            if ($this->fechainicio === null || $dt === null || $dt->format("Y-m-d") !== $this->fechainicio->format("Y-m-d")) {
                $this->fechainicio = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ViajeTableMap::COL_FECHAINICIO] = true;
            }
        } // if either are not null

        return $this;
    } // setFechainicio()

    /**
     * Set the value of [fechafinal] column.
     * 
     * @param string $v new value
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function setFechafinal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fechafinal !== $v) {
            $this->fechafinal = $v;
            $this->modifiedColumns[ViajeTableMap::COL_FECHAFINAL] = true;
        }

        return $this;
    } // setFechafinal()

    /**
     * Set the value of [informacion] column.
     * 
     * @param string $v new value
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function setInformacion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->informacion !== $v) {
            $this->informacion = $v;
            $this->modifiedColumns[ViajeTableMap::COL_INFORMACION] = true;
        }

        return $this;
    } // setInformacion()

    /**
     * Set the value of [imagenes] column.
     * 
     * @param string $v new value
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function setImagenes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->imagenes !== $v) {
            $this->imagenes = $v;
            $this->modifiedColumns[ViajeTableMap::COL_IMAGENES] = true;
        }

        return $this;
    } // setImagenes()

    /**
     * Set the value of [precio] column.
     * 
     * @param double $v new value
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function setPrecio($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->precio !== $v) {
            $this->precio = $v;
            $this->modifiedColumns[ViajeTableMap::COL_PRECIO] = true;
        }

        return $this;
    } // setPrecio()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ViajeTableMap::translateFieldName('Idviaje', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idviaje = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ViajeTableMap::translateFieldName('Transporte', TableMap::TYPE_PHPNAME, $indexType)];
            $this->transporte = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ViajeTableMap::translateFieldName('Nombre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ViajeTableMap::translateFieldName('Destino', TableMap::TYPE_PHPNAME, $indexType)];
            $this->destino = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ViajeTableMap::translateFieldName('Etiquetas', TableMap::TYPE_PHPNAME, $indexType)];
            $this->etiquetas = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ViajeTableMap::translateFieldName('Hospedaje', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hospedaje = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ViajeTableMap::translateFieldName('Fechainicio', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fechainicio = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ViajeTableMap::translateFieldName('Fechafinal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fechafinal = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ViajeTableMap::translateFieldName('Informacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->informacion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ViajeTableMap::translateFieldName('Imagenes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->imagenes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ViajeTableMap::translateFieldName('Precio', TableMap::TYPE_PHPNAME, $indexType)];
            $this->precio = (null !== $col) ? (double) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = ViajeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Viaje'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ViajeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildViajeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collViajess = null;

            $this->collMensajess = null;

            $this->collGrupoViajes = null;

            $this->collUsuarios = null;
            $this->collGrupos = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Viaje::setDeleted()
     * @see Viaje::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ViajeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildViajeQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ViajeTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ViajeTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->usuariosScheduledForDeletion !== null) {
                if (!$this->usuariosScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->usuariosScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getIdviaje();
                        $entryPk[0] = $entry->getIdusuario();
                        $pks[] = $entryPk;
                    }

                    \ViajesQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->usuariosScheduledForDeletion = null;
                }

            }

            if ($this->collUsuarios) {
                foreach ($this->collUsuarios as $usuario) {
                    if (!$usuario->isDeleted() && ($usuario->isNew() || $usuario->isModified())) {
                        $usuario->save($con);
                    }
                }
            }


            if ($this->gruposScheduledForDeletion !== null) {
                if (!$this->gruposScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->gruposScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getIdviaje();
                        $entryPk[0] = $entry->getIdgrupo();
                        $pks[] = $entryPk;
                    }

                    \GrupoViajeQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->gruposScheduledForDeletion = null;
                }

            }

            if ($this->collGrupos) {
                foreach ($this->collGrupos as $grupo) {
                    if (!$grupo->isDeleted() && ($grupo->isNew() || $grupo->isModified())) {
                        $grupo->save($con);
                    }
                }
            }


            if ($this->viajessScheduledForDeletion !== null) {
                if (!$this->viajessScheduledForDeletion->isEmpty()) {
                    \ViajesQuery::create()
                        ->filterByPrimaryKeys($this->viajessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->viajessScheduledForDeletion = null;
                }
            }

            if ($this->collViajess !== null) {
                foreach ($this->collViajess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->mensajessScheduledForDeletion !== null) {
                if (!$this->mensajessScheduledForDeletion->isEmpty()) {
                    foreach ($this->mensajessScheduledForDeletion as $mensajes) {
                        // need to save related object because we set the relation to null
                        $mensajes->save($con);
                    }
                    $this->mensajessScheduledForDeletion = null;
                }
            }

            if ($this->collMensajess !== null) {
                foreach ($this->collMensajess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->grupoViajesScheduledForDeletion !== null) {
                if (!$this->grupoViajesScheduledForDeletion->isEmpty()) {
                    \GrupoViajeQuery::create()
                        ->filterByPrimaryKeys($this->grupoViajesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->grupoViajesScheduledForDeletion = null;
                }
            }

            if ($this->collGrupoViajes !== null) {
                foreach ($this->collGrupoViajes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[ViajeTableMap::COL_IDVIAJE] = true;
        if (null !== $this->idviaje) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ViajeTableMap::COL_IDVIAJE . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ViajeTableMap::COL_IDVIAJE)) {
            $modifiedColumns[':p' . $index++]  = 'idViaje';
        }
        if ($this->isColumnModified(ViajeTableMap::COL_TRANSPORTE)) {
            $modifiedColumns[':p' . $index++]  = 'transporte';
        }
        if ($this->isColumnModified(ViajeTableMap::COL_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = 'nombre';
        }
        if ($this->isColumnModified(ViajeTableMap::COL_DESTINO)) {
            $modifiedColumns[':p' . $index++]  = 'destino';
        }
        if ($this->isColumnModified(ViajeTableMap::COL_ETIQUETAS)) {
            $modifiedColumns[':p' . $index++]  = 'etiquetas';
        }
        if ($this->isColumnModified(ViajeTableMap::COL_HOSPEDAJE)) {
            $modifiedColumns[':p' . $index++]  = 'hospedaje';
        }
        if ($this->isColumnModified(ViajeTableMap::COL_FECHAINICIO)) {
            $modifiedColumns[':p' . $index++]  = 'fechainicio';
        }
        if ($this->isColumnModified(ViajeTableMap::COL_FECHAFINAL)) {
            $modifiedColumns[':p' . $index++]  = 'fechafinal';
        }
        if ($this->isColumnModified(ViajeTableMap::COL_INFORMACION)) {
            $modifiedColumns[':p' . $index++]  = 'informacion';
        }
        if ($this->isColumnModified(ViajeTableMap::COL_IMAGENES)) {
            $modifiedColumns[':p' . $index++]  = 'imagenes';
        }
        if ($this->isColumnModified(ViajeTableMap::COL_PRECIO)) {
            $modifiedColumns[':p' . $index++]  = 'precio';
        }

        $sql = sprintf(
            'INSERT INTO Viaje (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'idViaje':                        
                        $stmt->bindValue($identifier, $this->idviaje, PDO::PARAM_INT);
                        break;
                    case 'transporte':                        
                        $stmt->bindValue($identifier, $this->transporte, PDO::PARAM_STR);
                        break;
                    case 'nombre':                        
                        $stmt->bindValue($identifier, $this->nombre, PDO::PARAM_STR);
                        break;
                    case 'destino':                        
                        $stmt->bindValue($identifier, $this->destino, PDO::PARAM_STR);
                        break;
                    case 'etiquetas':                        
                        $stmt->bindValue($identifier, $this->etiquetas, PDO::PARAM_STR);
                        break;
                    case 'hospedaje':                        
                        $stmt->bindValue($identifier, $this->hospedaje, PDO::PARAM_STR);
                        break;
                    case 'fechainicio':                        
                        $stmt->bindValue($identifier, $this->fechainicio ? $this->fechainicio->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'fechafinal':                        
                        $stmt->bindValue($identifier, $this->fechafinal, PDO::PARAM_STR);
                        break;
                    case 'informacion':                        
                        $stmt->bindValue($identifier, $this->informacion, PDO::PARAM_STR);
                        break;
                    case 'imagenes':                        
                        $stmt->bindValue($identifier, $this->imagenes, PDO::PARAM_STR);
                        break;
                    case 'precio':                        
                        $stmt->bindValue($identifier, $this->precio, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdviaje($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ViajeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdviaje();
                break;
            case 1:
                return $this->getTransporte();
                break;
            case 2:
                return $this->getNombre();
                break;
            case 3:
                return $this->getDestino();
                break;
            case 4:
                return $this->getEtiquetas();
                break;
            case 5:
                return $this->getHospedaje();
                break;
            case 6:
                return $this->getFechainicio();
                break;
            case 7:
                return $this->getFechafinal();
                break;
            case 8:
                return $this->getInformacion();
                break;
            case 9:
                return $this->getImagenes();
                break;
            case 10:
                return $this->getPrecio();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Viaje'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Viaje'][$this->hashCode()] = true;
        $keys = ViajeTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdviaje(),
            $keys[1] => $this->getTransporte(),
            $keys[2] => $this->getNombre(),
            $keys[3] => $this->getDestino(),
            $keys[4] => $this->getEtiquetas(),
            $keys[5] => $this->getHospedaje(),
            $keys[6] => $this->getFechainicio(),
            $keys[7] => $this->getFechafinal(),
            $keys[8] => $this->getInformacion(),
            $keys[9] => $this->getImagenes(),
            $keys[10] => $this->getPrecio(),
        );
        if ($result[$keys[6]] instanceof \DateTime) {
            $result[$keys[6]] = $result[$keys[6]]->format('c');
        }
        
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->collViajess) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'viajess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'viajess';
                        break;
                    default:
                        $key = 'Viajess';
                }
        
                $result[$key] = $this->collViajess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMensajess) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'mensajess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Mensajess';
                        break;
                    default:
                        $key = 'Mensajess';
                }
        
                $result[$key] = $this->collMensajess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGrupoViajes) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'grupoViajes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Grupo_viajes';
                        break;
                    default:
                        $key = 'GrupoViajes';
                }
        
                $result[$key] = $this->collGrupoViajes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Viaje
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ViajeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Viaje
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdviaje($value);
                break;
            case 1:
                $this->setTransporte($value);
                break;
            case 2:
                $this->setNombre($value);
                break;
            case 3:
                $this->setDestino($value);
                break;
            case 4:
                $this->setEtiquetas($value);
                break;
            case 5:
                $this->setHospedaje($value);
                break;
            case 6:
                $this->setFechainicio($value);
                break;
            case 7:
                $this->setFechafinal($value);
                break;
            case 8:
                $this->setInformacion($value);
                break;
            case 9:
                $this->setImagenes($value);
                break;
            case 10:
                $this->setPrecio($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ViajeTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdviaje($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTransporte($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setNombre($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDestino($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEtiquetas($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setHospedaje($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setFechainicio($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setFechafinal($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setInformacion($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setImagenes($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPrecio($arr[$keys[10]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Viaje The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ViajeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ViajeTableMap::COL_IDVIAJE)) {
            $criteria->add(ViajeTableMap::COL_IDVIAJE, $this->idviaje);
        }
        if ($this->isColumnModified(ViajeTableMap::COL_TRANSPORTE)) {
            $criteria->add(ViajeTableMap::COL_TRANSPORTE, $this->transporte);
        }
        if ($this->isColumnModified(ViajeTableMap::COL_NOMBRE)) {
            $criteria->add(ViajeTableMap::COL_NOMBRE, $this->nombre);
        }
        if ($this->isColumnModified(ViajeTableMap::COL_DESTINO)) {
            $criteria->add(ViajeTableMap::COL_DESTINO, $this->destino);
        }
        if ($this->isColumnModified(ViajeTableMap::COL_ETIQUETAS)) {
            $criteria->add(ViajeTableMap::COL_ETIQUETAS, $this->etiquetas);
        }
        if ($this->isColumnModified(ViajeTableMap::COL_HOSPEDAJE)) {
            $criteria->add(ViajeTableMap::COL_HOSPEDAJE, $this->hospedaje);
        }
        if ($this->isColumnModified(ViajeTableMap::COL_FECHAINICIO)) {
            $criteria->add(ViajeTableMap::COL_FECHAINICIO, $this->fechainicio);
        }
        if ($this->isColumnModified(ViajeTableMap::COL_FECHAFINAL)) {
            $criteria->add(ViajeTableMap::COL_FECHAFINAL, $this->fechafinal);
        }
        if ($this->isColumnModified(ViajeTableMap::COL_INFORMACION)) {
            $criteria->add(ViajeTableMap::COL_INFORMACION, $this->informacion);
        }
        if ($this->isColumnModified(ViajeTableMap::COL_IMAGENES)) {
            $criteria->add(ViajeTableMap::COL_IMAGENES, $this->imagenes);
        }
        if ($this->isColumnModified(ViajeTableMap::COL_PRECIO)) {
            $criteria->add(ViajeTableMap::COL_PRECIO, $this->precio);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildViajeQuery::create();
        $criteria->add(ViajeTableMap::COL_IDVIAJE, $this->idviaje);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIdviaje();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }
        
    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdviaje();
    }

    /**
     * Generic method to set the primary key (idviaje column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdviaje($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdviaje();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Viaje (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTransporte($this->getTransporte());
        $copyObj->setNombre($this->getNombre());
        $copyObj->setDestino($this->getDestino());
        $copyObj->setEtiquetas($this->getEtiquetas());
        $copyObj->setHospedaje($this->getHospedaje());
        $copyObj->setFechainicio($this->getFechainicio());
        $copyObj->setFechafinal($this->getFechafinal());
        $copyObj->setInformacion($this->getInformacion());
        $copyObj->setImagenes($this->getImagenes());
        $copyObj->setPrecio($this->getPrecio());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getViajess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addViajes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMensajess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMensajes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGrupoViajes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGrupoViaje($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdviaje(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Viaje Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Viajes' == $relationName) {
            return $this->initViajess();
        }
        if ('Mensajes' == $relationName) {
            return $this->initMensajess();
        }
        if ('GrupoViaje' == $relationName) {
            return $this->initGrupoViajes();
        }
    }

    /**
     * Clears out the collViajess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addViajess()
     */
    public function clearViajess()
    {
        $this->collViajess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collViajess collection loaded partially.
     */
    public function resetPartialViajess($v = true)
    {
        $this->collViajessPartial = $v;
    }

    /**
     * Initializes the collViajess collection.
     *
     * By default this just sets the collViajess collection to an empty array (like clearcollViajess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initViajess($overrideExisting = true)
    {
        if (null !== $this->collViajess && !$overrideExisting) {
            return;
        }

        $collectionClassName = ViajesTableMap::getTableMap()->getCollectionClassName();

        $this->collViajess = new $collectionClassName;
        $this->collViajess->setModel('\Viajes');
    }

    /**
     * Gets an array of ChildViajes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildViaje is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildViajes[] List of ChildViajes objects
     * @throws PropelException
     */
    public function getViajess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collViajessPartial && !$this->isNew();
        if (null === $this->collViajess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collViajess) {
                // return empty collection
                $this->initViajess();
            } else {
                $collViajess = ChildViajesQuery::create(null, $criteria)
                    ->filterByViaje($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collViajessPartial && count($collViajess)) {
                        $this->initViajess(false);

                        foreach ($collViajess as $obj) {
                            if (false == $this->collViajess->contains($obj)) {
                                $this->collViajess->append($obj);
                            }
                        }

                        $this->collViajessPartial = true;
                    }

                    return $collViajess;
                }

                if ($partial && $this->collViajess) {
                    foreach ($this->collViajess as $obj) {
                        if ($obj->isNew()) {
                            $collViajess[] = $obj;
                        }
                    }
                }

                $this->collViajess = $collViajess;
                $this->collViajessPartial = false;
            }
        }

        return $this->collViajess;
    }

    /**
     * Sets a collection of ChildViajes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $viajess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildViaje The current object (for fluent API support)
     */
    public function setViajess(Collection $viajess, ConnectionInterface $con = null)
    {
        /** @var ChildViajes[] $viajessToDelete */
        $viajessToDelete = $this->getViajess(new Criteria(), $con)->diff($viajess);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->viajessScheduledForDeletion = clone $viajessToDelete;

        foreach ($viajessToDelete as $viajesRemoved) {
            $viajesRemoved->setViaje(null);
        }

        $this->collViajess = null;
        foreach ($viajess as $viajes) {
            $this->addViajes($viajes);
        }

        $this->collViajess = $viajess;
        $this->collViajessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Viajes objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Viajes objects.
     * @throws PropelException
     */
    public function countViajess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collViajessPartial && !$this->isNew();
        if (null === $this->collViajess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collViajess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getViajess());
            }

            $query = ChildViajesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByViaje($this)
                ->count($con);
        }

        return count($this->collViajess);
    }

    /**
     * Method called to associate a ChildViajes object to this object
     * through the ChildViajes foreign key attribute.
     *
     * @param  ChildViajes $l ChildViajes
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function addViajes(ChildViajes $l)
    {
        if ($this->collViajess === null) {
            $this->initViajess();
            $this->collViajessPartial = true;
        }

        if (!$this->collViajess->contains($l)) {
            $this->doAddViajes($l);

            if ($this->viajessScheduledForDeletion and $this->viajessScheduledForDeletion->contains($l)) {
                $this->viajessScheduledForDeletion->remove($this->viajessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildViajes $viajes The ChildViajes object to add.
     */
    protected function doAddViajes(ChildViajes $viajes)
    {
        $this->collViajess[]= $viajes;
        $viajes->setViaje($this);
    }

    /**
     * @param  ChildViajes $viajes The ChildViajes object to remove.
     * @return $this|ChildViaje The current object (for fluent API support)
     */
    public function removeViajes(ChildViajes $viajes)
    {
        if ($this->getViajess()->contains($viajes)) {
            $pos = $this->collViajess->search($viajes);
            $this->collViajess->remove($pos);
            if (null === $this->viajessScheduledForDeletion) {
                $this->viajessScheduledForDeletion = clone $this->collViajess;
                $this->viajessScheduledForDeletion->clear();
            }
            $this->viajessScheduledForDeletion[]= clone $viajes;
            $viajes->setViaje(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Viaje is new, it will return
     * an empty collection; or if this Viaje has previously
     * been saved, it will retrieve related Viajess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Viaje.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildViajes[] List of ChildViajes objects
     */
    public function getViajessJoinUsuario(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildViajesQuery::create(null, $criteria);
        $query->joinWith('Usuario', $joinBehavior);

        return $this->getViajess($query, $con);
    }

    /**
     * Clears out the collMensajess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMensajess()
     */
    public function clearMensajess()
    {
        $this->collMensajess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collMensajess collection loaded partially.
     */
    public function resetPartialMensajess($v = true)
    {
        $this->collMensajessPartial = $v;
    }

    /**
     * Initializes the collMensajess collection.
     *
     * By default this just sets the collMensajess collection to an empty array (like clearcollMensajess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMensajess($overrideExisting = true)
    {
        if (null !== $this->collMensajess && !$overrideExisting) {
            return;
        }

        $collectionClassName = MensajesTableMap::getTableMap()->getCollectionClassName();

        $this->collMensajess = new $collectionClassName;
        $this->collMensajess->setModel('\Mensajes');
    }

    /**
     * Gets an array of ChildMensajes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildViaje is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMensajes[] List of ChildMensajes objects
     * @throws PropelException
     */
    public function getMensajess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collMensajessPartial && !$this->isNew();
        if (null === $this->collMensajess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMensajess) {
                // return empty collection
                $this->initMensajess();
            } else {
                $collMensajess = ChildMensajesQuery::create(null, $criteria)
                    ->filterByViaje($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMensajessPartial && count($collMensajess)) {
                        $this->initMensajess(false);

                        foreach ($collMensajess as $obj) {
                            if (false == $this->collMensajess->contains($obj)) {
                                $this->collMensajess->append($obj);
                            }
                        }

                        $this->collMensajessPartial = true;
                    }

                    return $collMensajess;
                }

                if ($partial && $this->collMensajess) {
                    foreach ($this->collMensajess as $obj) {
                        if ($obj->isNew()) {
                            $collMensajess[] = $obj;
                        }
                    }
                }

                $this->collMensajess = $collMensajess;
                $this->collMensajessPartial = false;
            }
        }

        return $this->collMensajess;
    }

    /**
     * Sets a collection of ChildMensajes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $mensajess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildViaje The current object (for fluent API support)
     */
    public function setMensajess(Collection $mensajess, ConnectionInterface $con = null)
    {
        /** @var ChildMensajes[] $mensajessToDelete */
        $mensajessToDelete = $this->getMensajess(new Criteria(), $con)->diff($mensajess);

        
        $this->mensajessScheduledForDeletion = $mensajessToDelete;

        foreach ($mensajessToDelete as $mensajesRemoved) {
            $mensajesRemoved->setViaje(null);
        }

        $this->collMensajess = null;
        foreach ($mensajess as $mensajes) {
            $this->addMensajes($mensajes);
        }

        $this->collMensajess = $mensajess;
        $this->collMensajessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Mensajes objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Mensajes objects.
     * @throws PropelException
     */
    public function countMensajess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collMensajessPartial && !$this->isNew();
        if (null === $this->collMensajess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMensajess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMensajess());
            }

            $query = ChildMensajesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByViaje($this)
                ->count($con);
        }

        return count($this->collMensajess);
    }

    /**
     * Method called to associate a ChildMensajes object to this object
     * through the ChildMensajes foreign key attribute.
     *
     * @param  ChildMensajes $l ChildMensajes
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function addMensajes(ChildMensajes $l)
    {
        if ($this->collMensajess === null) {
            $this->initMensajess();
            $this->collMensajessPartial = true;
        }

        if (!$this->collMensajess->contains($l)) {
            $this->doAddMensajes($l);

            if ($this->mensajessScheduledForDeletion and $this->mensajessScheduledForDeletion->contains($l)) {
                $this->mensajessScheduledForDeletion->remove($this->mensajessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMensajes $mensajes The ChildMensajes object to add.
     */
    protected function doAddMensajes(ChildMensajes $mensajes)
    {
        $this->collMensajess[]= $mensajes;
        $mensajes->setViaje($this);
    }

    /**
     * @param  ChildMensajes $mensajes The ChildMensajes object to remove.
     * @return $this|ChildViaje The current object (for fluent API support)
     */
    public function removeMensajes(ChildMensajes $mensajes)
    {
        if ($this->getMensajess()->contains($mensajes)) {
            $pos = $this->collMensajess->search($mensajes);
            $this->collMensajess->remove($pos);
            if (null === $this->mensajessScheduledForDeletion) {
                $this->mensajessScheduledForDeletion = clone $this->collMensajess;
                $this->mensajessScheduledForDeletion->clear();
            }
            $this->mensajessScheduledForDeletion[]= $mensajes;
            $mensajes->setViaje(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Viaje is new, it will return
     * an empty collection; or if this Viaje has previously
     * been saved, it will retrieve related Mensajess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Viaje.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMensajes[] List of ChildMensajes objects
     */
    public function getMensajessJoinMensajesRelatedByFkpadre(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMensajesQuery::create(null, $criteria);
        $query->joinWith('MensajesRelatedByFkpadre', $joinBehavior);

        return $this->getMensajess($query, $con);
    }

    /**
     * Clears out the collGrupoViajes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addGrupoViajes()
     */
    public function clearGrupoViajes()
    {
        $this->collGrupoViajes = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collGrupoViajes collection loaded partially.
     */
    public function resetPartialGrupoViajes($v = true)
    {
        $this->collGrupoViajesPartial = $v;
    }

    /**
     * Initializes the collGrupoViajes collection.
     *
     * By default this just sets the collGrupoViajes collection to an empty array (like clearcollGrupoViajes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGrupoViajes($overrideExisting = true)
    {
        if (null !== $this->collGrupoViajes && !$overrideExisting) {
            return;
        }

        $collectionClassName = GrupoViajeTableMap::getTableMap()->getCollectionClassName();

        $this->collGrupoViajes = new $collectionClassName;
        $this->collGrupoViajes->setModel('\GrupoViaje');
    }

    /**
     * Gets an array of ChildGrupoViaje objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildViaje is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGrupoViaje[] List of ChildGrupoViaje objects
     * @throws PropelException
     */
    public function getGrupoViajes(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collGrupoViajesPartial && !$this->isNew();
        if (null === $this->collGrupoViajes || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGrupoViajes) {
                // return empty collection
                $this->initGrupoViajes();
            } else {
                $collGrupoViajes = ChildGrupoViajeQuery::create(null, $criteria)
                    ->filterByViaje($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGrupoViajesPartial && count($collGrupoViajes)) {
                        $this->initGrupoViajes(false);

                        foreach ($collGrupoViajes as $obj) {
                            if (false == $this->collGrupoViajes->contains($obj)) {
                                $this->collGrupoViajes->append($obj);
                            }
                        }

                        $this->collGrupoViajesPartial = true;
                    }

                    return $collGrupoViajes;
                }

                if ($partial && $this->collGrupoViajes) {
                    foreach ($this->collGrupoViajes as $obj) {
                        if ($obj->isNew()) {
                            $collGrupoViajes[] = $obj;
                        }
                    }
                }

                $this->collGrupoViajes = $collGrupoViajes;
                $this->collGrupoViajesPartial = false;
            }
        }

        return $this->collGrupoViajes;
    }

    /**
     * Sets a collection of ChildGrupoViaje objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $grupoViajes A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildViaje The current object (for fluent API support)
     */
    public function setGrupoViajes(Collection $grupoViajes, ConnectionInterface $con = null)
    {
        /** @var ChildGrupoViaje[] $grupoViajesToDelete */
        $grupoViajesToDelete = $this->getGrupoViajes(new Criteria(), $con)->diff($grupoViajes);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->grupoViajesScheduledForDeletion = clone $grupoViajesToDelete;

        foreach ($grupoViajesToDelete as $grupoViajeRemoved) {
            $grupoViajeRemoved->setViaje(null);
        }

        $this->collGrupoViajes = null;
        foreach ($grupoViajes as $grupoViaje) {
            $this->addGrupoViaje($grupoViaje);
        }

        $this->collGrupoViajes = $grupoViajes;
        $this->collGrupoViajesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GrupoViaje objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related GrupoViaje objects.
     * @throws PropelException
     */
    public function countGrupoViajes(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collGrupoViajesPartial && !$this->isNew();
        if (null === $this->collGrupoViajes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGrupoViajes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGrupoViajes());
            }

            $query = ChildGrupoViajeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByViaje($this)
                ->count($con);
        }

        return count($this->collGrupoViajes);
    }

    /**
     * Method called to associate a ChildGrupoViaje object to this object
     * through the ChildGrupoViaje foreign key attribute.
     *
     * @param  ChildGrupoViaje $l ChildGrupoViaje
     * @return $this|\Viaje The current object (for fluent API support)
     */
    public function addGrupoViaje(ChildGrupoViaje $l)
    {
        if ($this->collGrupoViajes === null) {
            $this->initGrupoViajes();
            $this->collGrupoViajesPartial = true;
        }

        if (!$this->collGrupoViajes->contains($l)) {
            $this->doAddGrupoViaje($l);

            if ($this->grupoViajesScheduledForDeletion and $this->grupoViajesScheduledForDeletion->contains($l)) {
                $this->grupoViajesScheduledForDeletion->remove($this->grupoViajesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGrupoViaje $grupoViaje The ChildGrupoViaje object to add.
     */
    protected function doAddGrupoViaje(ChildGrupoViaje $grupoViaje)
    {
        $this->collGrupoViajes[]= $grupoViaje;
        $grupoViaje->setViaje($this);
    }

    /**
     * @param  ChildGrupoViaje $grupoViaje The ChildGrupoViaje object to remove.
     * @return $this|ChildViaje The current object (for fluent API support)
     */
    public function removeGrupoViaje(ChildGrupoViaje $grupoViaje)
    {
        if ($this->getGrupoViajes()->contains($grupoViaje)) {
            $pos = $this->collGrupoViajes->search($grupoViaje);
            $this->collGrupoViajes->remove($pos);
            if (null === $this->grupoViajesScheduledForDeletion) {
                $this->grupoViajesScheduledForDeletion = clone $this->collGrupoViajes;
                $this->grupoViajesScheduledForDeletion->clear();
            }
            $this->grupoViajesScheduledForDeletion[]= clone $grupoViaje;
            $grupoViaje->setViaje(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Viaje is new, it will return
     * an empty collection; or if this Viaje has previously
     * been saved, it will retrieve related GrupoViajes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Viaje.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGrupoViaje[] List of ChildGrupoViaje objects
     */
    public function getGrupoViajesJoinGrupo(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGrupoViajeQuery::create(null, $criteria);
        $query->joinWith('Grupo', $joinBehavior);

        return $this->getGrupoViajes($query, $con);
    }

    /**
     * Clears out the collUsuarios collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsuarios()
     */
    public function clearUsuarios()
    {
        $this->collUsuarios = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collUsuarios crossRef collection.
     *
     * By default this just sets the collUsuarios collection to an empty collection (like clearUsuarios());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initUsuarios()
    {
        $collectionClassName = ViajesTableMap::getTableMap()->getCollectionClassName();

        $this->collUsuarios = new $collectionClassName;
        $this->collUsuariosPartial = true;
        $this->collUsuarios->setModel('\Usuario');
    }

    /**
     * Checks if the collUsuarios collection is loaded.
     *
     * @return bool
     */
    public function isUsuariosLoaded()
    {
        return null !== $this->collUsuarios;
    }

    /**
     * Gets a collection of ChildUsuario objects related by a many-to-many relationship
     * to the current object by way of the viajes cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildViaje is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildUsuario[] List of ChildUsuario objects
     */
    public function getUsuarios(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUsuariosPartial && !$this->isNew();
        if (null === $this->collUsuarios || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collUsuarios) {
                    $this->initUsuarios();
                }
            } else {

                $query = ChildUsuarioQuery::create(null, $criteria)
                    ->filterByViaje($this);
                $collUsuarios = $query->find($con);
                if (null !== $criteria) {
                    return $collUsuarios;
                }

                if ($partial && $this->collUsuarios) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collUsuarios as $obj) {
                        if (!$collUsuarios->contains($obj)) {
                            $collUsuarios[] = $obj;
                        }
                    }
                }

                $this->collUsuarios = $collUsuarios;
                $this->collUsuariosPartial = false;
            }
        }

        return $this->collUsuarios;
    }

    /**
     * Sets a collection of Usuario objects related by a many-to-many relationship
     * to the current object by way of the viajes cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $usuarios A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildViaje The current object (for fluent API support)
     */
    public function setUsuarios(Collection $usuarios, ConnectionInterface $con = null)
    {
        $this->clearUsuarios();
        $currentUsuarios = $this->getUsuarios();

        $usuariosScheduledForDeletion = $currentUsuarios->diff($usuarios);

        foreach ($usuariosScheduledForDeletion as $toDelete) {
            $this->removeUsuario($toDelete);
        }

        foreach ($usuarios as $usuario) {
            if (!$currentUsuarios->contains($usuario)) {
                $this->doAddUsuario($usuario);
            }
        }

        $this->collUsuariosPartial = false;
        $this->collUsuarios = $usuarios;

        return $this;
    }

    /**
     * Gets the number of Usuario objects related by a many-to-many relationship
     * to the current object by way of the viajes cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Usuario objects
     */
    public function countUsuarios(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUsuariosPartial && !$this->isNew();
        if (null === $this->collUsuarios || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsuarios) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getUsuarios());
                }

                $query = ChildUsuarioQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByViaje($this)
                    ->count($con);
            }
        } else {
            return count($this->collUsuarios);
        }
    }

    /**
     * Associate a ChildUsuario to this object
     * through the viajes cross reference table.
     * 
     * @param ChildUsuario $usuario
     * @return ChildViaje The current object (for fluent API support)
     */
    public function addUsuario(ChildUsuario $usuario)
    {
        if ($this->collUsuarios === null) {
            $this->initUsuarios();
        }

        if (!$this->getUsuarios()->contains($usuario)) {
            // only add it if the **same** object is not already associated
            $this->collUsuarios->push($usuario);
            $this->doAddUsuario($usuario);
        }

        return $this;
    }

    /**
     * 
     * @param ChildUsuario $usuario
     */
    protected function doAddUsuario(ChildUsuario $usuario)
    {
        $viajes = new ChildViajes();

        $viajes->setUsuario($usuario);

        $viajes->setViaje($this);

        $this->addViajes($viajes);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$usuario->isViajesLoaded()) {
            $usuario->initViajes();
            $usuario->getViajes()->push($this);
        } elseif (!$usuario->getViajes()->contains($this)) {
            $usuario->getViajes()->push($this);
        }

    }

    /**
     * Remove usuario of this object
     * through the viajes cross reference table.
     * 
     * @param ChildUsuario $usuario
     * @return ChildViaje The current object (for fluent API support)
     */
    public function removeUsuario(ChildUsuario $usuario)
    {
        if ($this->getUsuarios()->contains($usuario)) { $viajes = new ChildViajes();

            $viajes->setUsuario($usuario);
            if ($usuario->isViajesLoaded()) {
                //remove the back reference if available
                $usuario->getViajes()->removeObject($this);
            }

            $viajes->setViaje($this);
            $this->removeViajes(clone $viajes);
            $viajes->clear();

            $this->collUsuarios->remove($this->collUsuarios->search($usuario));
            
            if (null === $this->usuariosScheduledForDeletion) {
                $this->usuariosScheduledForDeletion = clone $this->collUsuarios;
                $this->usuariosScheduledForDeletion->clear();
            }

            $this->usuariosScheduledForDeletion->push($usuario);
        }


        return $this;
    }

    /**
     * Clears out the collGrupos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addGrupos()
     */
    public function clearGrupos()
    {
        $this->collGrupos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collGrupos crossRef collection.
     *
     * By default this just sets the collGrupos collection to an empty collection (like clearGrupos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initGrupos()
    {
        $collectionClassName = GrupoViajeTableMap::getTableMap()->getCollectionClassName();

        $this->collGrupos = new $collectionClassName;
        $this->collGruposPartial = true;
        $this->collGrupos->setModel('\Grupo');
    }

    /**
     * Checks if the collGrupos collection is loaded.
     *
     * @return bool
     */
    public function isGruposLoaded()
    {
        return null !== $this->collGrupos;
    }

    /**
     * Gets a collection of ChildGrupo objects related by a many-to-many relationship
     * to the current object by way of the Grupo_viaje cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildViaje is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildGrupo[] List of ChildGrupo objects
     */
    public function getGrupos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collGruposPartial && !$this->isNew();
        if (null === $this->collGrupos || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collGrupos) {
                    $this->initGrupos();
                }
            } else {

                $query = ChildGrupoQuery::create(null, $criteria)
                    ->filterByViaje($this);
                $collGrupos = $query->find($con);
                if (null !== $criteria) {
                    return $collGrupos;
                }

                if ($partial && $this->collGrupos) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collGrupos as $obj) {
                        if (!$collGrupos->contains($obj)) {
                            $collGrupos[] = $obj;
                        }
                    }
                }

                $this->collGrupos = $collGrupos;
                $this->collGruposPartial = false;
            }
        }

        return $this->collGrupos;
    }

    /**
     * Sets a collection of Grupo objects related by a many-to-many relationship
     * to the current object by way of the Grupo_viaje cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $grupos A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildViaje The current object (for fluent API support)
     */
    public function setGrupos(Collection $grupos, ConnectionInterface $con = null)
    {
        $this->clearGrupos();
        $currentGrupos = $this->getGrupos();

        $gruposScheduledForDeletion = $currentGrupos->diff($grupos);

        foreach ($gruposScheduledForDeletion as $toDelete) {
            $this->removeGrupo($toDelete);
        }

        foreach ($grupos as $grupo) {
            if (!$currentGrupos->contains($grupo)) {
                $this->doAddGrupo($grupo);
            }
        }

        $this->collGruposPartial = false;
        $this->collGrupos = $grupos;

        return $this;
    }

    /**
     * Gets the number of Grupo objects related by a many-to-many relationship
     * to the current object by way of the Grupo_viaje cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Grupo objects
     */
    public function countGrupos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collGruposPartial && !$this->isNew();
        if (null === $this->collGrupos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGrupos) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getGrupos());
                }

                $query = ChildGrupoQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByViaje($this)
                    ->count($con);
            }
        } else {
            return count($this->collGrupos);
        }
    }

    /**
     * Associate a ChildGrupo to this object
     * through the Grupo_viaje cross reference table.
     * 
     * @param ChildGrupo $grupo
     * @return ChildViaje The current object (for fluent API support)
     */
    public function addGrupo(ChildGrupo $grupo)
    {
        if ($this->collGrupos === null) {
            $this->initGrupos();
        }

        if (!$this->getGrupos()->contains($grupo)) {
            // only add it if the **same** object is not already associated
            $this->collGrupos->push($grupo);
            $this->doAddGrupo($grupo);
        }

        return $this;
    }

    /**
     * 
     * @param ChildGrupo $grupo
     */
    protected function doAddGrupo(ChildGrupo $grupo)
    {
        $grupoViaje = new ChildGrupoViaje();

        $grupoViaje->setGrupo($grupo);

        $grupoViaje->setViaje($this);

        $this->addGrupoViaje($grupoViaje);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$grupo->isViajesLoaded()) {
            $grupo->initViajes();
            $grupo->getViajes()->push($this);
        } elseif (!$grupo->getViajes()->contains($this)) {
            $grupo->getViajes()->push($this);
        }

    }

    /**
     * Remove grupo of this object
     * through the Grupo_viaje cross reference table.
     * 
     * @param ChildGrupo $grupo
     * @return ChildViaje The current object (for fluent API support)
     */
    public function removeGrupo(ChildGrupo $grupo)
    {
        if ($this->getGrupos()->contains($grupo)) { $grupoViaje = new ChildGrupoViaje();

            $grupoViaje->setGrupo($grupo);
            if ($grupo->isViajesLoaded()) {
                //remove the back reference if available
                $grupo->getViajes()->removeObject($this);
            }

            $grupoViaje->setViaje($this);
            $this->removeGrupoViaje(clone $grupoViaje);
            $grupoViaje->clear();

            $this->collGrupos->remove($this->collGrupos->search($grupo));
            
            if (null === $this->gruposScheduledForDeletion) {
                $this->gruposScheduledForDeletion = clone $this->collGrupos;
                $this->gruposScheduledForDeletion->clear();
            }

            $this->gruposScheduledForDeletion->push($grupo);
        }


        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->idviaje = null;
        $this->transporte = null;
        $this->nombre = null;
        $this->destino = null;
        $this->etiquetas = null;
        $this->hospedaje = null;
        $this->fechainicio = null;
        $this->fechafinal = null;
        $this->informacion = null;
        $this->imagenes = null;
        $this->precio = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collViajess) {
                foreach ($this->collViajess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMensajess) {
                foreach ($this->collMensajess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGrupoViajes) {
                foreach ($this->collGrupoViajes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsuarios) {
                foreach ($this->collUsuarios as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGrupos) {
                foreach ($this->collGrupos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collViajess = null;
        $this->collMensajess = null;
        $this->collGrupoViajes = null;
        $this->collUsuarios = null;
        $this->collGrupos = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ViajeTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
