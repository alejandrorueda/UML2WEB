<?php

namespace Base;

use \Grupo as ChildGrupo;
use \GrupoQuery as ChildGrupoQuery;
use \GrupoViaje as ChildGrupoViaje;
use \GrupoViajeQuery as ChildGrupoViajeQuery;
use \Usuario as ChildUsuario;
use \UsuarioGrupos as ChildUsuarioGrupos;
use \UsuarioGruposQuery as ChildUsuarioGruposQuery;
use \UsuarioQuery as ChildUsuarioQuery;
use \Viaje as ChildViaje;
use \ViajeQuery as ChildViajeQuery;
use \Exception;
use \PDO;
use Map\GrupoTableMap;
use Map\GrupoViajeTableMap;
use Map\UsuarioGruposTableMap;
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

/**
 * Base class that represents a row from the 'Grupo' table.
 *
 * 
 *
 * @package    propel.generator..Base
 */
abstract class Grupo implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\GrupoTableMap';


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
     * The value for the idgrupo field.
     * 
     * @var        int
     */
    protected $idgrupo;

    /**
     * The value for the nombre field.
     * 
     * @var        string
     */
    protected $nombre;

    /**
     * The value for the informacion field.
     * 
     * @var        string
     */
    protected $informacion;

    /**
     * @var        ObjectCollection|ChildUsuarioGrupos[] Collection to store aggregation of ChildUsuarioGrupos objects.
     */
    protected $collUsuarioGruposs;
    protected $collUsuarioGrupossPartial;

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
     * @var        ObjectCollection|ChildViaje[] Cross Collection to store aggregation of ChildViaje objects.
     */
    protected $collViajes;

    /**
     * @var bool
     */
    protected $collViajesPartial;

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
     * @var ObjectCollection|ChildViaje[]
     */
    protected $viajesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUsuarioGrupos[]
     */
    protected $usuarioGrupossScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGrupoViaje[]
     */
    protected $grupoViajesScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Grupo object.
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
     * Compares this with another <code>Grupo</code> instance.  If
     * <code>obj</code> is an instance of <code>Grupo</code>, delegates to
     * <code>equals(Grupo)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Grupo The current object, for fluid interface
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
     * Get the [idgrupo] column value.
     * 
     * @return int
     */
    public function getIdgrupo()
    {
        return $this->idgrupo;
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
     * Get the [informacion] column value.
     * 
     * @return string
     */
    public function getInformacion()
    {
        return $this->informacion;
    }

    /**
     * Set the value of [idgrupo] column.
     * 
     * @param int $v new value
     * @return $this|\Grupo The current object (for fluent API support)
     */
    public function setIdgrupo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idgrupo !== $v) {
            $this->idgrupo = $v;
            $this->modifiedColumns[GrupoTableMap::COL_IDGRUPO] = true;
        }

        return $this;
    } // setIdgrupo()

    /**
     * Set the value of [nombre] column.
     * 
     * @param string $v new value
     * @return $this|\Grupo The current object (for fluent API support)
     */
    public function setNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre !== $v) {
            $this->nombre = $v;
            $this->modifiedColumns[GrupoTableMap::COL_NOMBRE] = true;
        }

        return $this;
    } // setNombre()

    /**
     * Set the value of [informacion] column.
     * 
     * @param string $v new value
     * @return $this|\Grupo The current object (for fluent API support)
     */
    public function setInformacion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->informacion !== $v) {
            $this->informacion = $v;
            $this->modifiedColumns[GrupoTableMap::COL_INFORMACION] = true;
        }

        return $this;
    } // setInformacion()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : GrupoTableMap::translateFieldName('Idgrupo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idgrupo = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : GrupoTableMap::translateFieldName('Nombre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : GrupoTableMap::translateFieldName('Informacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->informacion = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = GrupoTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Grupo'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(GrupoTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildGrupoQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collUsuarioGruposs = null;

            $this->collGrupoViajes = null;

            $this->collUsuarios = null;
            $this->collViajes = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Grupo::setDeleted()
     * @see Grupo::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildGrupoQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoTableMap::DATABASE_NAME);
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
                GrupoTableMap::addInstanceToPool($this);
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

                        $entryPk[1] = $this->getIdgrupo();
                        $entryPk[0] = $entry->getIdusuario();
                        $pks[] = $entryPk;
                    }

                    \UsuarioGruposQuery::create()
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


            if ($this->viajesScheduledForDeletion !== null) {
                if (!$this->viajesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->viajesScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getIdgrupo();
                        $entryPk[1] = $entry->getIdviaje();
                        $pks[] = $entryPk;
                    }

                    \GrupoViajeQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->viajesScheduledForDeletion = null;
                }

            }

            if ($this->collViajes) {
                foreach ($this->collViajes as $viaje) {
                    if (!$viaje->isDeleted() && ($viaje->isNew() || $viaje->isModified())) {
                        $viaje->save($con);
                    }
                }
            }


            if ($this->usuarioGrupossScheduledForDeletion !== null) {
                if (!$this->usuarioGrupossScheduledForDeletion->isEmpty()) {
                    \UsuarioGruposQuery::create()
                        ->filterByPrimaryKeys($this->usuarioGrupossScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->usuarioGrupossScheduledForDeletion = null;
                }
            }

            if ($this->collUsuarioGruposs !== null) {
                foreach ($this->collUsuarioGruposs as $referrerFK) {
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

        $this->modifiedColumns[GrupoTableMap::COL_IDGRUPO] = true;
        if (null !== $this->idgrupo) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GrupoTableMap::COL_IDGRUPO . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GrupoTableMap::COL_IDGRUPO)) {
            $modifiedColumns[':p' . $index++]  = 'idGrupo';
        }
        if ($this->isColumnModified(GrupoTableMap::COL_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = 'nombre';
        }
        if ($this->isColumnModified(GrupoTableMap::COL_INFORMACION)) {
            $modifiedColumns[':p' . $index++]  = 'informacion';
        }

        $sql = sprintf(
            'INSERT INTO Grupo (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'idGrupo':                        
                        $stmt->bindValue($identifier, $this->idgrupo, PDO::PARAM_INT);
                        break;
                    case 'nombre':                        
                        $stmt->bindValue($identifier, $this->nombre, PDO::PARAM_STR);
                        break;
                    case 'informacion':                        
                        $stmt->bindValue($identifier, $this->informacion, PDO::PARAM_STR);
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
        $this->setIdgrupo($pk);

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
        $pos = GrupoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdgrupo();
                break;
            case 1:
                return $this->getNombre();
                break;
            case 2:
                return $this->getInformacion();
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

        if (isset($alreadyDumpedObjects['Grupo'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Grupo'][$this->hashCode()] = true;
        $keys = GrupoTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdgrupo(),
            $keys[1] => $this->getNombre(),
            $keys[2] => $this->getInformacion(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->collUsuarioGruposs) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'usuarioGruposs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Usuario_gruposs';
                        break;
                    default:
                        $key = 'UsuarioGruposs';
                }
        
                $result[$key] = $this->collUsuarioGruposs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Grupo
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = GrupoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Grupo
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdgrupo($value);
                break;
            case 1:
                $this->setNombre($value);
                break;
            case 2:
                $this->setInformacion($value);
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
        $keys = GrupoTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdgrupo($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNombre($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setInformacion($arr[$keys[2]]);
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
     * @return $this|\Grupo The current object, for fluid interface
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
        $criteria = new Criteria(GrupoTableMap::DATABASE_NAME);

        if ($this->isColumnModified(GrupoTableMap::COL_IDGRUPO)) {
            $criteria->add(GrupoTableMap::COL_IDGRUPO, $this->idgrupo);
        }
        if ($this->isColumnModified(GrupoTableMap::COL_NOMBRE)) {
            $criteria->add(GrupoTableMap::COL_NOMBRE, $this->nombre);
        }
        if ($this->isColumnModified(GrupoTableMap::COL_INFORMACION)) {
            $criteria->add(GrupoTableMap::COL_INFORMACION, $this->informacion);
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
        $criteria = ChildGrupoQuery::create();
        $criteria->add(GrupoTableMap::COL_IDGRUPO, $this->idgrupo);

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
        $validPk = null !== $this->getIdgrupo();

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
        return $this->getIdgrupo();
    }

    /**
     * Generic method to set the primary key (idgrupo column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdgrupo($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdgrupo();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Grupo (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNombre($this->getNombre());
        $copyObj->setInformacion($this->getInformacion());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getUsuarioGruposs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsuarioGrupos($relObj->copy($deepCopy));
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
            $copyObj->setIdgrupo(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Grupo Clone of current object.
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
        if ('UsuarioGrupos' == $relationName) {
            return $this->initUsuarioGruposs();
        }
        if ('GrupoViaje' == $relationName) {
            return $this->initGrupoViajes();
        }
    }

    /**
     * Clears out the collUsuarioGruposs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsuarioGruposs()
     */
    public function clearUsuarioGruposs()
    {
        $this->collUsuarioGruposs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUsuarioGruposs collection loaded partially.
     */
    public function resetPartialUsuarioGruposs($v = true)
    {
        $this->collUsuarioGrupossPartial = $v;
    }

    /**
     * Initializes the collUsuarioGruposs collection.
     *
     * By default this just sets the collUsuarioGruposs collection to an empty array (like clearcollUsuarioGruposs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsuarioGruposs($overrideExisting = true)
    {
        if (null !== $this->collUsuarioGruposs && !$overrideExisting) {
            return;
        }

        $collectionClassName = UsuarioGruposTableMap::getTableMap()->getCollectionClassName();

        $this->collUsuarioGruposs = new $collectionClassName;
        $this->collUsuarioGruposs->setModel('\UsuarioGrupos');
    }

    /**
     * Gets an array of ChildUsuarioGrupos objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGrupo is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUsuarioGrupos[] List of ChildUsuarioGrupos objects
     * @throws PropelException
     */
    public function getUsuarioGruposs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUsuarioGrupossPartial && !$this->isNew();
        if (null === $this->collUsuarioGruposs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsuarioGruposs) {
                // return empty collection
                $this->initUsuarioGruposs();
            } else {
                $collUsuarioGruposs = ChildUsuarioGruposQuery::create(null, $criteria)
                    ->filterByGrupo($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUsuarioGrupossPartial && count($collUsuarioGruposs)) {
                        $this->initUsuarioGruposs(false);

                        foreach ($collUsuarioGruposs as $obj) {
                            if (false == $this->collUsuarioGruposs->contains($obj)) {
                                $this->collUsuarioGruposs->append($obj);
                            }
                        }

                        $this->collUsuarioGrupossPartial = true;
                    }

                    return $collUsuarioGruposs;
                }

                if ($partial && $this->collUsuarioGruposs) {
                    foreach ($this->collUsuarioGruposs as $obj) {
                        if ($obj->isNew()) {
                            $collUsuarioGruposs[] = $obj;
                        }
                    }
                }

                $this->collUsuarioGruposs = $collUsuarioGruposs;
                $this->collUsuarioGrupossPartial = false;
            }
        }

        return $this->collUsuarioGruposs;
    }

    /**
     * Sets a collection of ChildUsuarioGrupos objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $usuarioGruposs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildGrupo The current object (for fluent API support)
     */
    public function setUsuarioGruposs(Collection $usuarioGruposs, ConnectionInterface $con = null)
    {
        /** @var ChildUsuarioGrupos[] $usuarioGrupossToDelete */
        $usuarioGrupossToDelete = $this->getUsuarioGruposs(new Criteria(), $con)->diff($usuarioGruposs);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->usuarioGrupossScheduledForDeletion = clone $usuarioGrupossToDelete;

        foreach ($usuarioGrupossToDelete as $usuarioGruposRemoved) {
            $usuarioGruposRemoved->setGrupo(null);
        }

        $this->collUsuarioGruposs = null;
        foreach ($usuarioGruposs as $usuarioGrupos) {
            $this->addUsuarioGrupos($usuarioGrupos);
        }

        $this->collUsuarioGruposs = $usuarioGruposs;
        $this->collUsuarioGrupossPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UsuarioGrupos objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related UsuarioGrupos objects.
     * @throws PropelException
     */
    public function countUsuarioGruposs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUsuarioGrupossPartial && !$this->isNew();
        if (null === $this->collUsuarioGruposs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsuarioGruposs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsuarioGruposs());
            }

            $query = ChildUsuarioGruposQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGrupo($this)
                ->count($con);
        }

        return count($this->collUsuarioGruposs);
    }

    /**
     * Method called to associate a ChildUsuarioGrupos object to this object
     * through the ChildUsuarioGrupos foreign key attribute.
     *
     * @param  ChildUsuarioGrupos $l ChildUsuarioGrupos
     * @return $this|\Grupo The current object (for fluent API support)
     */
    public function addUsuarioGrupos(ChildUsuarioGrupos $l)
    {
        if ($this->collUsuarioGruposs === null) {
            $this->initUsuarioGruposs();
            $this->collUsuarioGrupossPartial = true;
        }

        if (!$this->collUsuarioGruposs->contains($l)) {
            $this->doAddUsuarioGrupos($l);

            if ($this->usuarioGrupossScheduledForDeletion and $this->usuarioGrupossScheduledForDeletion->contains($l)) {
                $this->usuarioGrupossScheduledForDeletion->remove($this->usuarioGrupossScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUsuarioGrupos $usuarioGrupos The ChildUsuarioGrupos object to add.
     */
    protected function doAddUsuarioGrupos(ChildUsuarioGrupos $usuarioGrupos)
    {
        $this->collUsuarioGruposs[]= $usuarioGrupos;
        $usuarioGrupos->setGrupo($this);
    }

    /**
     * @param  ChildUsuarioGrupos $usuarioGrupos The ChildUsuarioGrupos object to remove.
     * @return $this|ChildGrupo The current object (for fluent API support)
     */
    public function removeUsuarioGrupos(ChildUsuarioGrupos $usuarioGrupos)
    {
        if ($this->getUsuarioGruposs()->contains($usuarioGrupos)) {
            $pos = $this->collUsuarioGruposs->search($usuarioGrupos);
            $this->collUsuarioGruposs->remove($pos);
            if (null === $this->usuarioGrupossScheduledForDeletion) {
                $this->usuarioGrupossScheduledForDeletion = clone $this->collUsuarioGruposs;
                $this->usuarioGrupossScheduledForDeletion->clear();
            }
            $this->usuarioGrupossScheduledForDeletion[]= clone $usuarioGrupos;
            $usuarioGrupos->setGrupo(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Grupo is new, it will return
     * an empty collection; or if this Grupo has previously
     * been saved, it will retrieve related UsuarioGruposs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Grupo.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUsuarioGrupos[] List of ChildUsuarioGrupos objects
     */
    public function getUsuarioGrupossJoinUsuario(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUsuarioGruposQuery::create(null, $criteria);
        $query->joinWith('Usuario', $joinBehavior);

        return $this->getUsuarioGruposs($query, $con);
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
     * If this ChildGrupo is new, it will return
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
                    ->filterByGrupo($this)
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
     * @return $this|ChildGrupo The current object (for fluent API support)
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
            $grupoViajeRemoved->setGrupo(null);
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
                ->filterByGrupo($this)
                ->count($con);
        }

        return count($this->collGrupoViajes);
    }

    /**
     * Method called to associate a ChildGrupoViaje object to this object
     * through the ChildGrupoViaje foreign key attribute.
     *
     * @param  ChildGrupoViaje $l ChildGrupoViaje
     * @return $this|\Grupo The current object (for fluent API support)
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
        $grupoViaje->setGrupo($this);
    }

    /**
     * @param  ChildGrupoViaje $grupoViaje The ChildGrupoViaje object to remove.
     * @return $this|ChildGrupo The current object (for fluent API support)
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
            $grupoViaje->setGrupo(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Grupo is new, it will return
     * an empty collection; or if this Grupo has previously
     * been saved, it will retrieve related GrupoViajes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Grupo.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGrupoViaje[] List of ChildGrupoViaje objects
     */
    public function getGrupoViajesJoinViaje(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGrupoViajeQuery::create(null, $criteria);
        $query->joinWith('Viaje', $joinBehavior);

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
        $collectionClassName = UsuarioGruposTableMap::getTableMap()->getCollectionClassName();

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
     * to the current object by way of the Usuario_grupos cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGrupo is new, it will return
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
                    ->filterByGrupo($this);
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
     * to the current object by way of the Usuario_grupos cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $usuarios A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildGrupo The current object (for fluent API support)
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
     * to the current object by way of the Usuario_grupos cross-reference table.
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
                    ->filterByGrupo($this)
                    ->count($con);
            }
        } else {
            return count($this->collUsuarios);
        }
    }

    /**
     * Associate a ChildUsuario to this object
     * through the Usuario_grupos cross reference table.
     * 
     * @param ChildUsuario $usuario
     * @return ChildGrupo The current object (for fluent API support)
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
        $usuarioGrupos = new ChildUsuarioGrupos();

        $usuarioGrupos->setUsuario($usuario);

        $usuarioGrupos->setGrupo($this);

        $this->addUsuarioGrupos($usuarioGrupos);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$usuario->isGruposLoaded()) {
            $usuario->initGrupos();
            $usuario->getGrupos()->push($this);
        } elseif (!$usuario->getGrupos()->contains($this)) {
            $usuario->getGrupos()->push($this);
        }

    }

    /**
     * Remove usuario of this object
     * through the Usuario_grupos cross reference table.
     * 
     * @param ChildUsuario $usuario
     * @return ChildGrupo The current object (for fluent API support)
     */
    public function removeUsuario(ChildUsuario $usuario)
    {
        if ($this->getUsuarios()->contains($usuario)) { $usuarioGrupos = new ChildUsuarioGrupos();

            $usuarioGrupos->setUsuario($usuario);
            if ($usuario->isGruposLoaded()) {
                //remove the back reference if available
                $usuario->getGrupos()->removeObject($this);
            }

            $usuarioGrupos->setGrupo($this);
            $this->removeUsuarioGrupos(clone $usuarioGrupos);
            $usuarioGrupos->clear();

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
     * Clears out the collViajes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addViajes()
     */
    public function clearViajes()
    {
        $this->collViajes = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collViajes crossRef collection.
     *
     * By default this just sets the collViajes collection to an empty collection (like clearViajes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initViajes()
    {
        $collectionClassName = GrupoViajeTableMap::getTableMap()->getCollectionClassName();

        $this->collViajes = new $collectionClassName;
        $this->collViajesPartial = true;
        $this->collViajes->setModel('\Viaje');
    }

    /**
     * Checks if the collViajes collection is loaded.
     *
     * @return bool
     */
    public function isViajesLoaded()
    {
        return null !== $this->collViajes;
    }

    /**
     * Gets a collection of ChildViaje objects related by a many-to-many relationship
     * to the current object by way of the Grupo_viaje cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGrupo is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildViaje[] List of ChildViaje objects
     */
    public function getViajes(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collViajesPartial && !$this->isNew();
        if (null === $this->collViajes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collViajes) {
                    $this->initViajes();
                }
            } else {

                $query = ChildViajeQuery::create(null, $criteria)
                    ->filterByGrupo($this);
                $collViajes = $query->find($con);
                if (null !== $criteria) {
                    return $collViajes;
                }

                if ($partial && $this->collViajes) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collViajes as $obj) {
                        if (!$collViajes->contains($obj)) {
                            $collViajes[] = $obj;
                        }
                    }
                }

                $this->collViajes = $collViajes;
                $this->collViajesPartial = false;
            }
        }

        return $this->collViajes;
    }

    /**
     * Sets a collection of Viaje objects related by a many-to-many relationship
     * to the current object by way of the Grupo_viaje cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $viajes A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildGrupo The current object (for fluent API support)
     */
    public function setViajes(Collection $viajes, ConnectionInterface $con = null)
    {
        $this->clearViajes();
        $currentViajes = $this->getViajes();

        $viajesScheduledForDeletion = $currentViajes->diff($viajes);

        foreach ($viajesScheduledForDeletion as $toDelete) {
            $this->removeViaje($toDelete);
        }

        foreach ($viajes as $viaje) {
            if (!$currentViajes->contains($viaje)) {
                $this->doAddViaje($viaje);
            }
        }

        $this->collViajesPartial = false;
        $this->collViajes = $viajes;

        return $this;
    }

    /**
     * Gets the number of Viaje objects related by a many-to-many relationship
     * to the current object by way of the Grupo_viaje cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Viaje objects
     */
    public function countViajes(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collViajesPartial && !$this->isNew();
        if (null === $this->collViajes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collViajes) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getViajes());
                }

                $query = ChildViajeQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByGrupo($this)
                    ->count($con);
            }
        } else {
            return count($this->collViajes);
        }
    }

    /**
     * Associate a ChildViaje to this object
     * through the Grupo_viaje cross reference table.
     * 
     * @param ChildViaje $viaje
     * @return ChildGrupo The current object (for fluent API support)
     */
    public function addViaje(ChildViaje $viaje)
    {
        if ($this->collViajes === null) {
            $this->initViajes();
        }

        if (!$this->getViajes()->contains($viaje)) {
            // only add it if the **same** object is not already associated
            $this->collViajes->push($viaje);
            $this->doAddViaje($viaje);
        }

        return $this;
    }

    /**
     * 
     * @param ChildViaje $viaje
     */
    protected function doAddViaje(ChildViaje $viaje)
    {
        $grupoViaje = new ChildGrupoViaje();

        $grupoViaje->setViaje($viaje);

        $grupoViaje->setGrupo($this);

        $this->addGrupoViaje($grupoViaje);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$viaje->isGruposLoaded()) {
            $viaje->initGrupos();
            $viaje->getGrupos()->push($this);
        } elseif (!$viaje->getGrupos()->contains($this)) {
            $viaje->getGrupos()->push($this);
        }

    }

    /**
     * Remove viaje of this object
     * through the Grupo_viaje cross reference table.
     * 
     * @param ChildViaje $viaje
     * @return ChildGrupo The current object (for fluent API support)
     */
    public function removeViaje(ChildViaje $viaje)
    {
        if ($this->getViajes()->contains($viaje)) { $grupoViaje = new ChildGrupoViaje();

            $grupoViaje->setViaje($viaje);
            if ($viaje->isGruposLoaded()) {
                //remove the back reference if available
                $viaje->getGrupos()->removeObject($this);
            }

            $grupoViaje->setGrupo($this);
            $this->removeGrupoViaje(clone $grupoViaje);
            $grupoViaje->clear();

            $this->collViajes->remove($this->collViajes->search($viaje));
            
            if (null === $this->viajesScheduledForDeletion) {
                $this->viajesScheduledForDeletion = clone $this->collViajes;
                $this->viajesScheduledForDeletion->clear();
            }

            $this->viajesScheduledForDeletion->push($viaje);
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
        $this->idgrupo = null;
        $this->nombre = null;
        $this->informacion = null;
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
            if ($this->collUsuarioGruposs) {
                foreach ($this->collUsuarioGruposs as $o) {
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
            if ($this->collViajes) {
                foreach ($this->collViajes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collUsuarioGruposs = null;
        $this->collGrupoViajes = null;
        $this->collUsuarios = null;
        $this->collViajes = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(GrupoTableMap::DEFAULT_STRING_FORMAT);
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
