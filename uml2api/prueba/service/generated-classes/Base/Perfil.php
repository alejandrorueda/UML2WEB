<?php

namespace Base;

use \Administrador as ChildAdministrador;
use \AdministradorQuery as ChildAdministradorQuery;
use \Colaborador as ChildColaborador;
use \ColaboradorQuery as ChildColaboradorQuery;
use \Perfil as ChildPerfil;
use \PerfilQuery as ChildPerfilQuery;
use \Usuario as ChildUsuario;
use \UsuarioQuery as ChildUsuarioQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\AdministradorTableMap;
use Map\ColaboradorTableMap;
use Map\PerfilTableMap;
use Map\UsuarioTableMap;
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
 * Base class that represents a row from the 'Perfil' table.
 *
 * 
 *
 * @package    propel.generator..Base
 */
abstract class Perfil implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\PerfilTableMap';


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
     * The value for the idperfil field.
     * 
     * @var        int
     */
    protected $idperfil;

    /**
     * The value for the informacion field.
     * 
     * @var        string
     */
    protected $informacion;

    /**
     * The value for the nacimiento field.
     * 
     * @var        DateTime
     */
    protected $nacimiento;

    /**
     * The value for the gustos field.
     * 
     * @var        string
     */
    protected $gustos;

    /**
     * @var        ObjectCollection|ChildUsuario[] Collection to store aggregation of ChildUsuario objects.
     */
    protected $collUsuarios;
    protected $collUsuariosPartial;

    /**
     * @var        ObjectCollection|ChildAdministrador[] Collection to store aggregation of ChildAdministrador objects.
     */
    protected $collAdministradors;
    protected $collAdministradorsPartial;

    /**
     * @var        ObjectCollection|ChildColaborador[] Collection to store aggregation of ChildColaborador objects.
     */
    protected $collColaboradors;
    protected $collColaboradorsPartial;

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
     * @var ObjectCollection|ChildAdministrador[]
     */
    protected $administradorsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildColaborador[]
     */
    protected $colaboradorsScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Perfil object.
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
     * Compares this with another <code>Perfil</code> instance.  If
     * <code>obj</code> is an instance of <code>Perfil</code>, delegates to
     * <code>equals(Perfil)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Perfil The current object, for fluid interface
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
     * Get the [idperfil] column value.
     * 
     * @return int
     */
    public function getIdperfil()
    {
        return $this->idperfil;
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
     * Get the [optionally formatted] temporal [nacimiento] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getNacimiento($format = NULL)
    {
        if ($format === null) {
            return $this->nacimiento;
        } else {
            return $this->nacimiento instanceof \DateTimeInterface ? $this->nacimiento->format($format) : null;
        }
    }

    /**
     * Get the [gustos] column value.
     * 
     * @return string
     */
    public function getGustos()
    {
        return $this->gustos;
    }

    /**
     * Set the value of [idperfil] column.
     * 
     * @param int $v new value
     * @return $this|\Perfil The current object (for fluent API support)
     */
    public function setIdperfil($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idperfil !== $v) {
            $this->idperfil = $v;
            $this->modifiedColumns[PerfilTableMap::COL_IDPERFIL] = true;
        }

        return $this;
    } // setIdperfil()

    /**
     * Set the value of [informacion] column.
     * 
     * @param string $v new value
     * @return $this|\Perfil The current object (for fluent API support)
     */
    public function setInformacion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->informacion !== $v) {
            $this->informacion = $v;
            $this->modifiedColumns[PerfilTableMap::COL_INFORMACION] = true;
        }

        return $this;
    } // setInformacion()

    /**
     * Sets the value of [nacimiento] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Perfil The current object (for fluent API support)
     */
    public function setNacimiento($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->nacimiento !== null || $dt !== null) {
            if ($this->nacimiento === null || $dt === null || $dt->format("Y-m-d") !== $this->nacimiento->format("Y-m-d")) {
                $this->nacimiento = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PerfilTableMap::COL_NACIMIENTO] = true;
            }
        } // if either are not null

        return $this;
    } // setNacimiento()

    /**
     * Set the value of [gustos] column.
     * 
     * @param string $v new value
     * @return $this|\Perfil The current object (for fluent API support)
     */
    public function setGustos($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gustos !== $v) {
            $this->gustos = $v;
            $this->modifiedColumns[PerfilTableMap::COL_GUSTOS] = true;
        }

        return $this;
    } // setGustos()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PerfilTableMap::translateFieldName('Idperfil', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idperfil = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PerfilTableMap::translateFieldName('Informacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->informacion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PerfilTableMap::translateFieldName('Nacimiento', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->nacimiento = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PerfilTableMap::translateFieldName('Gustos', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gustos = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = PerfilTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Perfil'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(PerfilTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPerfilQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collUsuarios = null;

            $this->collAdministradors = null;

            $this->collColaboradors = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Perfil::setDeleted()
     * @see Perfil::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PerfilTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPerfilQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PerfilTableMap::DATABASE_NAME);
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
                PerfilTableMap::addInstanceToPool($this);
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
                    \UsuarioQuery::create()
                        ->filterByPrimaryKeys($this->usuariosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->usuariosScheduledForDeletion = null;
                }
            }

            if ($this->collUsuarios !== null) {
                foreach ($this->collUsuarios as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->administradorsScheduledForDeletion !== null) {
                if (!$this->administradorsScheduledForDeletion->isEmpty()) {
                    \AdministradorQuery::create()
                        ->filterByPrimaryKeys($this->administradorsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->administradorsScheduledForDeletion = null;
                }
            }

            if ($this->collAdministradors !== null) {
                foreach ($this->collAdministradors as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->colaboradorsScheduledForDeletion !== null) {
                if (!$this->colaboradorsScheduledForDeletion->isEmpty()) {
                    \ColaboradorQuery::create()
                        ->filterByPrimaryKeys($this->colaboradorsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->colaboradorsScheduledForDeletion = null;
                }
            }

            if ($this->collColaboradors !== null) {
                foreach ($this->collColaboradors as $referrerFK) {
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

        $this->modifiedColumns[PerfilTableMap::COL_IDPERFIL] = true;
        if (null !== $this->idperfil) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PerfilTableMap::COL_IDPERFIL . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PerfilTableMap::COL_IDPERFIL)) {
            $modifiedColumns[':p' . $index++]  = 'idPerfil';
        }
        if ($this->isColumnModified(PerfilTableMap::COL_INFORMACION)) {
            $modifiedColumns[':p' . $index++]  = 'informacion';
        }
        if ($this->isColumnModified(PerfilTableMap::COL_NACIMIENTO)) {
            $modifiedColumns[':p' . $index++]  = 'nacimiento';
        }
        if ($this->isColumnModified(PerfilTableMap::COL_GUSTOS)) {
            $modifiedColumns[':p' . $index++]  = 'gustos';
        }

        $sql = sprintf(
            'INSERT INTO Perfil (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'idPerfil':                        
                        $stmt->bindValue($identifier, $this->idperfil, PDO::PARAM_INT);
                        break;
                    case 'informacion':                        
                        $stmt->bindValue($identifier, $this->informacion, PDO::PARAM_STR);
                        break;
                    case 'nacimiento':                        
                        $stmt->bindValue($identifier, $this->nacimiento ? $this->nacimiento->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'gustos':                        
                        $stmt->bindValue($identifier, $this->gustos, PDO::PARAM_STR);
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
        $this->setIdperfil($pk);

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
        $pos = PerfilTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdperfil();
                break;
            case 1:
                return $this->getInformacion();
                break;
            case 2:
                return $this->getNacimiento();
                break;
            case 3:
                return $this->getGustos();
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

        if (isset($alreadyDumpedObjects['Perfil'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Perfil'][$this->hashCode()] = true;
        $keys = PerfilTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdperfil(),
            $keys[1] => $this->getInformacion(),
            $keys[2] => $this->getNacimiento(),
            $keys[3] => $this->getGustos(),
        );
        if ($result[$keys[2]] instanceof \DateTime) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }
        
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->collUsuarios) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'usuarios';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Usuarios';
                        break;
                    default:
                        $key = 'Usuarios';
                }
        
                $result[$key] = $this->collUsuarios->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAdministradors) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'administradors';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Administradors';
                        break;
                    default:
                        $key = 'Administradors';
                }
        
                $result[$key] = $this->collAdministradors->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collColaboradors) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'colaboradors';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Colaboradors';
                        break;
                    default:
                        $key = 'Colaboradors';
                }
        
                $result[$key] = $this->collColaboradors->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Perfil
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PerfilTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Perfil
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdperfil($value);
                break;
            case 1:
                $this->setInformacion($value);
                break;
            case 2:
                $this->setNacimiento($value);
                break;
            case 3:
                $this->setGustos($value);
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
        $keys = PerfilTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdperfil($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setInformacion($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setNacimiento($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setGustos($arr[$keys[3]]);
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
     * @return $this|\Perfil The current object, for fluid interface
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
        $criteria = new Criteria(PerfilTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PerfilTableMap::COL_IDPERFIL)) {
            $criteria->add(PerfilTableMap::COL_IDPERFIL, $this->idperfil);
        }
        if ($this->isColumnModified(PerfilTableMap::COL_INFORMACION)) {
            $criteria->add(PerfilTableMap::COL_INFORMACION, $this->informacion);
        }
        if ($this->isColumnModified(PerfilTableMap::COL_NACIMIENTO)) {
            $criteria->add(PerfilTableMap::COL_NACIMIENTO, $this->nacimiento);
        }
        if ($this->isColumnModified(PerfilTableMap::COL_GUSTOS)) {
            $criteria->add(PerfilTableMap::COL_GUSTOS, $this->gustos);
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
        $criteria = ChildPerfilQuery::create();
        $criteria->add(PerfilTableMap::COL_IDPERFIL, $this->idperfil);

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
        $validPk = null !== $this->getIdperfil();

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
        return $this->getIdperfil();
    }

    /**
     * Generic method to set the primary key (idperfil column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdperfil($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdperfil();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Perfil (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setInformacion($this->getInformacion());
        $copyObj->setNacimiento($this->getNacimiento());
        $copyObj->setGustos($this->getGustos());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getUsuarios() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsuario($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAdministradors() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAdministrador($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getColaboradors() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addColaborador($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdperfil(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Perfil Clone of current object.
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
        if ('Usuario' == $relationName) {
            return $this->initUsuarios();
        }
        if ('Administrador' == $relationName) {
            return $this->initAdministradors();
        }
        if ('Colaborador' == $relationName) {
            return $this->initColaboradors();
        }
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
     * Reset is the collUsuarios collection loaded partially.
     */
    public function resetPartialUsuarios($v = true)
    {
        $this->collUsuariosPartial = $v;
    }

    /**
     * Initializes the collUsuarios collection.
     *
     * By default this just sets the collUsuarios collection to an empty array (like clearcollUsuarios());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsuarios($overrideExisting = true)
    {
        if (null !== $this->collUsuarios && !$overrideExisting) {
            return;
        }

        $collectionClassName = UsuarioTableMap::getTableMap()->getCollectionClassName();

        $this->collUsuarios = new $collectionClassName;
        $this->collUsuarios->setModel('\Usuario');
    }

    /**
     * Gets an array of ChildUsuario objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerfil is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUsuario[] List of ChildUsuario objects
     * @throws PropelException
     */
    public function getUsuarios(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUsuariosPartial && !$this->isNew();
        if (null === $this->collUsuarios || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsuarios) {
                // return empty collection
                $this->initUsuarios();
            } else {
                $collUsuarios = ChildUsuarioQuery::create(null, $criteria)
                    ->filterByPerfil($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUsuariosPartial && count($collUsuarios)) {
                        $this->initUsuarios(false);

                        foreach ($collUsuarios as $obj) {
                            if (false == $this->collUsuarios->contains($obj)) {
                                $this->collUsuarios->append($obj);
                            }
                        }

                        $this->collUsuariosPartial = true;
                    }

                    return $collUsuarios;
                }

                if ($partial && $this->collUsuarios) {
                    foreach ($this->collUsuarios as $obj) {
                        if ($obj->isNew()) {
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
     * Sets a collection of ChildUsuario objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $usuarios A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerfil The current object (for fluent API support)
     */
    public function setUsuarios(Collection $usuarios, ConnectionInterface $con = null)
    {
        /** @var ChildUsuario[] $usuariosToDelete */
        $usuariosToDelete = $this->getUsuarios(new Criteria(), $con)->diff($usuarios);

        
        $this->usuariosScheduledForDeletion = $usuariosToDelete;

        foreach ($usuariosToDelete as $usuarioRemoved) {
            $usuarioRemoved->setPerfil(null);
        }

        $this->collUsuarios = null;
        foreach ($usuarios as $usuario) {
            $this->addUsuario($usuario);
        }

        $this->collUsuarios = $usuarios;
        $this->collUsuariosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Usuario objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Usuario objects.
     * @throws PropelException
     */
    public function countUsuarios(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUsuariosPartial && !$this->isNew();
        if (null === $this->collUsuarios || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsuarios) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsuarios());
            }

            $query = ChildUsuarioQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerfil($this)
                ->count($con);
        }

        return count($this->collUsuarios);
    }

    /**
     * Method called to associate a ChildUsuario object to this object
     * through the ChildUsuario foreign key attribute.
     *
     * @param  ChildUsuario $l ChildUsuario
     * @return $this|\Perfil The current object (for fluent API support)
     */
    public function addUsuario(ChildUsuario $l)
    {
        if ($this->collUsuarios === null) {
            $this->initUsuarios();
            $this->collUsuariosPartial = true;
        }

        if (!$this->collUsuarios->contains($l)) {
            $this->doAddUsuario($l);

            if ($this->usuariosScheduledForDeletion and $this->usuariosScheduledForDeletion->contains($l)) {
                $this->usuariosScheduledForDeletion->remove($this->usuariosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUsuario $usuario The ChildUsuario object to add.
     */
    protected function doAddUsuario(ChildUsuario $usuario)
    {
        $this->collUsuarios[]= $usuario;
        $usuario->setPerfil($this);
    }

    /**
     * @param  ChildUsuario $usuario The ChildUsuario object to remove.
     * @return $this|ChildPerfil The current object (for fluent API support)
     */
    public function removeUsuario(ChildUsuario $usuario)
    {
        if ($this->getUsuarios()->contains($usuario)) {
            $pos = $this->collUsuarios->search($usuario);
            $this->collUsuarios->remove($pos);
            if (null === $this->usuariosScheduledForDeletion) {
                $this->usuariosScheduledForDeletion = clone $this->collUsuarios;
                $this->usuariosScheduledForDeletion->clear();
            }
            $this->usuariosScheduledForDeletion[]= clone $usuario;
            $usuario->setPerfil(null);
        }

        return $this;
    }

    /**
     * Clears out the collAdministradors collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAdministradors()
     */
    public function clearAdministradors()
    {
        $this->collAdministradors = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAdministradors collection loaded partially.
     */
    public function resetPartialAdministradors($v = true)
    {
        $this->collAdministradorsPartial = $v;
    }

    /**
     * Initializes the collAdministradors collection.
     *
     * By default this just sets the collAdministradors collection to an empty array (like clearcollAdministradors());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAdministradors($overrideExisting = true)
    {
        if (null !== $this->collAdministradors && !$overrideExisting) {
            return;
        }

        $collectionClassName = AdministradorTableMap::getTableMap()->getCollectionClassName();

        $this->collAdministradors = new $collectionClassName;
        $this->collAdministradors->setModel('\Administrador');
    }

    /**
     * Gets an array of ChildAdministrador objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerfil is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAdministrador[] List of ChildAdministrador objects
     * @throws PropelException
     */
    public function getAdministradors(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAdministradorsPartial && !$this->isNew();
        if (null === $this->collAdministradors || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAdministradors) {
                // return empty collection
                $this->initAdministradors();
            } else {
                $collAdministradors = ChildAdministradorQuery::create(null, $criteria)
                    ->filterByPerfil($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAdministradorsPartial && count($collAdministradors)) {
                        $this->initAdministradors(false);

                        foreach ($collAdministradors as $obj) {
                            if (false == $this->collAdministradors->contains($obj)) {
                                $this->collAdministradors->append($obj);
                            }
                        }

                        $this->collAdministradorsPartial = true;
                    }

                    return $collAdministradors;
                }

                if ($partial && $this->collAdministradors) {
                    foreach ($this->collAdministradors as $obj) {
                        if ($obj->isNew()) {
                            $collAdministradors[] = $obj;
                        }
                    }
                }

                $this->collAdministradors = $collAdministradors;
                $this->collAdministradorsPartial = false;
            }
        }

        return $this->collAdministradors;
    }

    /**
     * Sets a collection of ChildAdministrador objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $administradors A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerfil The current object (for fluent API support)
     */
    public function setAdministradors(Collection $administradors, ConnectionInterface $con = null)
    {
        /** @var ChildAdministrador[] $administradorsToDelete */
        $administradorsToDelete = $this->getAdministradors(new Criteria(), $con)->diff($administradors);

        
        $this->administradorsScheduledForDeletion = $administradorsToDelete;

        foreach ($administradorsToDelete as $administradorRemoved) {
            $administradorRemoved->setPerfil(null);
        }

        $this->collAdministradors = null;
        foreach ($administradors as $administrador) {
            $this->addAdministrador($administrador);
        }

        $this->collAdministradors = $administradors;
        $this->collAdministradorsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Administrador objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Administrador objects.
     * @throws PropelException
     */
    public function countAdministradors(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAdministradorsPartial && !$this->isNew();
        if (null === $this->collAdministradors || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAdministradors) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAdministradors());
            }

            $query = ChildAdministradorQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerfil($this)
                ->count($con);
        }

        return count($this->collAdministradors);
    }

    /**
     * Method called to associate a ChildAdministrador object to this object
     * through the ChildAdministrador foreign key attribute.
     *
     * @param  ChildAdministrador $l ChildAdministrador
     * @return $this|\Perfil The current object (for fluent API support)
     */
    public function addAdministrador(ChildAdministrador $l)
    {
        if ($this->collAdministradors === null) {
            $this->initAdministradors();
            $this->collAdministradorsPartial = true;
        }

        if (!$this->collAdministradors->contains($l)) {
            $this->doAddAdministrador($l);

            if ($this->administradorsScheduledForDeletion and $this->administradorsScheduledForDeletion->contains($l)) {
                $this->administradorsScheduledForDeletion->remove($this->administradorsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAdministrador $administrador The ChildAdministrador object to add.
     */
    protected function doAddAdministrador(ChildAdministrador $administrador)
    {
        $this->collAdministradors[]= $administrador;
        $administrador->setPerfil($this);
    }

    /**
     * @param  ChildAdministrador $administrador The ChildAdministrador object to remove.
     * @return $this|ChildPerfil The current object (for fluent API support)
     */
    public function removeAdministrador(ChildAdministrador $administrador)
    {
        if ($this->getAdministradors()->contains($administrador)) {
            $pos = $this->collAdministradors->search($administrador);
            $this->collAdministradors->remove($pos);
            if (null === $this->administradorsScheduledForDeletion) {
                $this->administradorsScheduledForDeletion = clone $this->collAdministradors;
                $this->administradorsScheduledForDeletion->clear();
            }
            $this->administradorsScheduledForDeletion[]= clone $administrador;
            $administrador->setPerfil(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Perfil is new, it will return
     * an empty collection; or if this Perfil has previously
     * been saved, it will retrieve related Administradors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Perfil.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAdministrador[] List of ChildAdministrador objects
     */
    public function getAdministradorsJoinUsuario(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAdministradorQuery::create(null, $criteria);
        $query->joinWith('Usuario', $joinBehavior);

        return $this->getAdministradors($query, $con);
    }

    /**
     * Clears out the collColaboradors collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addColaboradors()
     */
    public function clearColaboradors()
    {
        $this->collColaboradors = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collColaboradors collection loaded partially.
     */
    public function resetPartialColaboradors($v = true)
    {
        $this->collColaboradorsPartial = $v;
    }

    /**
     * Initializes the collColaboradors collection.
     *
     * By default this just sets the collColaboradors collection to an empty array (like clearcollColaboradors());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initColaboradors($overrideExisting = true)
    {
        if (null !== $this->collColaboradors && !$overrideExisting) {
            return;
        }

        $collectionClassName = ColaboradorTableMap::getTableMap()->getCollectionClassName();

        $this->collColaboradors = new $collectionClassName;
        $this->collColaboradors->setModel('\Colaborador');
    }

    /**
     * Gets an array of ChildColaborador objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerfil is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildColaborador[] List of ChildColaborador objects
     * @throws PropelException
     */
    public function getColaboradors(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collColaboradorsPartial && !$this->isNew();
        if (null === $this->collColaboradors || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collColaboradors) {
                // return empty collection
                $this->initColaboradors();
            } else {
                $collColaboradors = ChildColaboradorQuery::create(null, $criteria)
                    ->filterByPerfil($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collColaboradorsPartial && count($collColaboradors)) {
                        $this->initColaboradors(false);

                        foreach ($collColaboradors as $obj) {
                            if (false == $this->collColaboradors->contains($obj)) {
                                $this->collColaboradors->append($obj);
                            }
                        }

                        $this->collColaboradorsPartial = true;
                    }

                    return $collColaboradors;
                }

                if ($partial && $this->collColaboradors) {
                    foreach ($this->collColaboradors as $obj) {
                        if ($obj->isNew()) {
                            $collColaboradors[] = $obj;
                        }
                    }
                }

                $this->collColaboradors = $collColaboradors;
                $this->collColaboradorsPartial = false;
            }
        }

        return $this->collColaboradors;
    }

    /**
     * Sets a collection of ChildColaborador objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $colaboradors A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerfil The current object (for fluent API support)
     */
    public function setColaboradors(Collection $colaboradors, ConnectionInterface $con = null)
    {
        /** @var ChildColaborador[] $colaboradorsToDelete */
        $colaboradorsToDelete = $this->getColaboradors(new Criteria(), $con)->diff($colaboradors);

        
        $this->colaboradorsScheduledForDeletion = $colaboradorsToDelete;

        foreach ($colaboradorsToDelete as $colaboradorRemoved) {
            $colaboradorRemoved->setPerfil(null);
        }

        $this->collColaboradors = null;
        foreach ($colaboradors as $colaborador) {
            $this->addColaborador($colaborador);
        }

        $this->collColaboradors = $colaboradors;
        $this->collColaboradorsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Colaborador objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Colaborador objects.
     * @throws PropelException
     */
    public function countColaboradors(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collColaboradorsPartial && !$this->isNew();
        if (null === $this->collColaboradors || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collColaboradors) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getColaboradors());
            }

            $query = ChildColaboradorQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerfil($this)
                ->count($con);
        }

        return count($this->collColaboradors);
    }

    /**
     * Method called to associate a ChildColaborador object to this object
     * through the ChildColaborador foreign key attribute.
     *
     * @param  ChildColaborador $l ChildColaborador
     * @return $this|\Perfil The current object (for fluent API support)
     */
    public function addColaborador(ChildColaborador $l)
    {
        if ($this->collColaboradors === null) {
            $this->initColaboradors();
            $this->collColaboradorsPartial = true;
        }

        if (!$this->collColaboradors->contains($l)) {
            $this->doAddColaborador($l);

            if ($this->colaboradorsScheduledForDeletion and $this->colaboradorsScheduledForDeletion->contains($l)) {
                $this->colaboradorsScheduledForDeletion->remove($this->colaboradorsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildColaborador $colaborador The ChildColaborador object to add.
     */
    protected function doAddColaborador(ChildColaborador $colaborador)
    {
        $this->collColaboradors[]= $colaborador;
        $colaborador->setPerfil($this);
    }

    /**
     * @param  ChildColaborador $colaborador The ChildColaborador object to remove.
     * @return $this|ChildPerfil The current object (for fluent API support)
     */
    public function removeColaborador(ChildColaborador $colaborador)
    {
        if ($this->getColaboradors()->contains($colaborador)) {
            $pos = $this->collColaboradors->search($colaborador);
            $this->collColaboradors->remove($pos);
            if (null === $this->colaboradorsScheduledForDeletion) {
                $this->colaboradorsScheduledForDeletion = clone $this->collColaboradors;
                $this->colaboradorsScheduledForDeletion->clear();
            }
            $this->colaboradorsScheduledForDeletion[]= clone $colaborador;
            $colaborador->setPerfil(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Perfil is new, it will return
     * an empty collection; or if this Perfil has previously
     * been saved, it will retrieve related Colaboradors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Perfil.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildColaborador[] List of ChildColaborador objects
     */
    public function getColaboradorsJoinUsuario(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildColaboradorQuery::create(null, $criteria);
        $query->joinWith('Usuario', $joinBehavior);

        return $this->getColaboradors($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->idperfil = null;
        $this->informacion = null;
        $this->nacimiento = null;
        $this->gustos = null;
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
            if ($this->collUsuarios) {
                foreach ($this->collUsuarios as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAdministradors) {
                foreach ($this->collAdministradors as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collColaboradors) {
                foreach ($this->collColaboradors as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collUsuarios = null;
        $this->collAdministradors = null;
        $this->collColaboradors = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PerfilTableMap::DEFAULT_STRING_FORMAT);
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
