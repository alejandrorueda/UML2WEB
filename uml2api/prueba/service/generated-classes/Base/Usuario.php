<?php

namespace Base;

use \Administrador as ChildAdministrador;
use \AdministradorQuery as ChildAdministradorQuery;
use \Amigos as ChildAmigos;
use \AmigosQuery as ChildAmigosQuery;
use \Colaborador as ChildColaborador;
use \ColaboradorQuery as ChildColaboradorQuery;
use \Grupo as ChildGrupo;
use \GrupoQuery as ChildGrupoQuery;
use \Invitacion as ChildInvitacion;
use \InvitacionQuery as ChildInvitacionQuery;
use \Perfil as ChildPerfil;
use \PerfilQuery as ChildPerfilQuery;
use \Usuario as ChildUsuario;
use \UsuarioGrupos as ChildUsuarioGrupos;
use \UsuarioGruposQuery as ChildUsuarioGruposQuery;
use \UsuarioQuery as ChildUsuarioQuery;
use \Viaje as ChildViaje;
use \ViajeQuery as ChildViajeQuery;
use \Viajes as ChildViajes;
use \ViajesQuery as ChildViajesQuery;
use \Exception;
use \PDO;
use Map\AdministradorTableMap;
use Map\AmigosTableMap;
use Map\ColaboradorTableMap;
use Map\InvitacionTableMap;
use Map\UsuarioGruposTableMap;
use Map\UsuarioTableMap;
use Map\ViajesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\PropelQuery;
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
 * Base class that represents a row from the 'Usuario' table.
 *
 * 
 *
 * @package    propel.generator..Base
 */
abstract class Usuario implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\UsuarioTableMap';


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
     * The value for the idusuario field.
     * 
     * @var        string
     */
    protected $idusuario;

    /**
     * The value for the password field.
     * 
     * @var        string
     */
    protected $password;

    /**
     * The value for the email field.
     * 
     * @var        string
     */
    protected $email;

    /**
     * The value for the avatar field.
     * 
     * @var        string
     */
    protected $avatar;

    /**
     * The value for the nombre field.
     * 
     * @var        string
     */
    protected $nombre;

    /**
     * The value for the apellidos field.
     * 
     * @var        string
     */
    protected $apellidos;

    /**
     * The value for the fkperfil field.
     * 
     * @var        int
     */
    protected $fkperfil;

    /**
     * The value for the descendant_class field.
     * 
     * @var        string
     */
    protected $descendant_class;

    /**
     * @var        ChildPerfil
     */
    protected $aPerfil;

    /**
     * @var        ObjectCollection|ChildAmigos[] Collection to store aggregation of ChildAmigos objects.
     */
    protected $collAmigossRelatedByIdusuario;
    protected $collAmigossRelatedByIdusuarioPartial;

    /**
     * @var        ObjectCollection|ChildAmigos[] Collection to store aggregation of ChildAmigos objects.
     */
    protected $collAmigossRelatedByRelacionusuario;
    protected $collAmigossRelatedByRelacionusuarioPartial;

    /**
     * @var        ObjectCollection|ChildViajes[] Collection to store aggregation of ChildViajes objects.
     */
    protected $collViajess;
    protected $collViajessPartial;

    /**
     * @var        ObjectCollection|ChildUsuarioGrupos[] Collection to store aggregation of ChildUsuarioGrupos objects.
     */
    protected $collUsuarioGruposs;
    protected $collUsuarioGrupossPartial;

    /**
     * @var        ObjectCollection|ChildInvitacion[] Collection to store aggregation of ChildInvitacion objects.
     */
    protected $collInvitacions;
    protected $collInvitacionsPartial;

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
     * @var        ObjectCollection|ChildUsuario[] Cross Collection to store aggregation of ChildUsuario objects.
     */
    protected $collUsuariosRelatedByRelacionusuario;

    /**
     * @var bool
     */
    protected $collUsuariosRelatedByRelacionusuarioPartial;

    /**
     * @var        ObjectCollection|ChildUsuario[] Cross Collection to store aggregation of ChildUsuario objects.
     */
    protected $collUsuariosRelatedByIdusuario;

    /**
     * @var bool
     */
    protected $collUsuariosRelatedByIdusuarioPartial;

    /**
     * @var        ObjectCollection|ChildViaje[] Cross Collection to store aggregation of ChildViaje objects.
     */
    protected $collViajes;

    /**
     * @var bool
     */
    protected $collViajesPartial;

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
    protected $usuariosRelatedByRelacionusuarioScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUsuario[]
     */
    protected $usuariosRelatedByIdusuarioScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildViaje[]
     */
    protected $viajesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGrupo[]
     */
    protected $gruposScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAmigos[]
     */
    protected $amigossRelatedByIdusuarioScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAmigos[]
     */
    protected $amigossRelatedByRelacionusuarioScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildViajes[]
     */
    protected $viajessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUsuarioGrupos[]
     */
    protected $usuarioGrupossScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildInvitacion[]
     */
    protected $invitacionsScheduledForDeletion = null;

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
     * Initializes internal state of Base\Usuario object.
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
     * Compares this with another <code>Usuario</code> instance.  If
     * <code>obj</code> is an instance of <code>Usuario</code>, delegates to
     * <code>equals(Usuario)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Usuario The current object, for fluid interface
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
     * Get the [idusuario] column value.
     * 
     * @return string
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Get the [password] column value.
     * 
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [email] column value.
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [avatar] column value.
     * 
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
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
     * Get the [apellidos] column value.
     * 
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Get the [fkperfil] column value.
     * 
     * @return int
     */
    public function getFkperfil()
    {
        return $this->fkperfil;
    }

    /**
     * Get the [descendant_class] column value.
     * 
     * @return string
     */
    public function getDescendantClass()
    {
        return $this->descendant_class;
    }

    /**
     * Set the value of [idusuario] column.
     * 
     * @param string $v new value
     * @return $this|\Usuario The current object (for fluent API support)
     */
    public function setIdusuario($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->idusuario !== $v) {
            $this->idusuario = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_IDUSUARIO] = true;
        }

        return $this;
    } // setIdusuario()

    /**
     * Set the value of [password] column.
     * 
     * @param string $v new value
     * @return $this|\Usuario The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_PASSWORD] = true;
        }

        return $this;
    } // setPassword()

    /**
     * Set the value of [email] column.
     * 
     * @param string $v new value
     * @return $this|\Usuario The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [avatar] column.
     * 
     * @param string $v new value
     * @return $this|\Usuario The current object (for fluent API support)
     */
    public function setAvatar($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->avatar !== $v) {
            $this->avatar = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_AVATAR] = true;
        }

        return $this;
    } // setAvatar()

    /**
     * Set the value of [nombre] column.
     * 
     * @param string $v new value
     * @return $this|\Usuario The current object (for fluent API support)
     */
    public function setNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre !== $v) {
            $this->nombre = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_NOMBRE] = true;
        }

        return $this;
    } // setNombre()

    /**
     * Set the value of [apellidos] column.
     * 
     * @param string $v new value
     * @return $this|\Usuario The current object (for fluent API support)
     */
    public function setApellidos($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->apellidos !== $v) {
            $this->apellidos = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_APELLIDOS] = true;
        }

        return $this;
    } // setApellidos()

    /**
     * Set the value of [fkperfil] column.
     * 
     * @param int $v new value
     * @return $this|\Usuario The current object (for fluent API support)
     */
    public function setFkperfil($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fkperfil !== $v) {
            $this->fkperfil = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_FKPERFIL] = true;
        }

        if ($this->aPerfil !== null && $this->aPerfil->getIdperfil() !== $v) {
            $this->aPerfil = null;
        }

        return $this;
    } // setFkperfil()

    /**
     * Set the value of [descendant_class] column.
     * 
     * @param string $v new value
     * @return $this|\Usuario The current object (for fluent API support)
     */
    public function setDescendantClass($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descendant_class !== $v) {
            $this->descendant_class = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_DESCENDANT_CLASS] = true;
        }

        return $this;
    } // setDescendantClass()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsuarioTableMap::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idusuario = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsuarioTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsuarioTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsuarioTableMap::translateFieldName('Avatar', TableMap::TYPE_PHPNAME, $indexType)];
            $this->avatar = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsuarioTableMap::translateFieldName('Nombre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsuarioTableMap::translateFieldName('Apellidos', TableMap::TYPE_PHPNAME, $indexType)];
            $this->apellidos = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsuarioTableMap::translateFieldName('Fkperfil', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fkperfil = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UsuarioTableMap::translateFieldName('DescendantClass', TableMap::TYPE_PHPNAME, $indexType)];
            $this->descendant_class = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = UsuarioTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Usuario'), 0, $e);
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
        if ($this->aPerfil !== null && $this->fkperfil !== $this->aPerfil->getIdperfil()) {
            $this->aPerfil = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(UsuarioTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsuarioQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPerfil = null;
            $this->collAmigossRelatedByIdusuario = null;

            $this->collAmigossRelatedByRelacionusuario = null;

            $this->collViajess = null;

            $this->collUsuarioGruposs = null;

            $this->collInvitacions = null;

            $this->collAdministradors = null;

            $this->collColaboradors = null;

            $this->collUsuariosRelatedByRelacionusuario = null;
            $this->collUsuariosRelatedByIdusuario = null;
            $this->collViajes = null;
            $this->collGrupos = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Usuario::setDeleted()
     * @see Usuario::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsuarioQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
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
                UsuarioTableMap::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aPerfil !== null) {
                if ($this->aPerfil->isModified() || $this->aPerfil->isNew()) {
                    $affectedRows += $this->aPerfil->save($con);
                }
                $this->setPerfil($this->aPerfil);
            }

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

            if ($this->usuariosRelatedByRelacionusuarioScheduledForDeletion !== null) {
                if (!$this->usuariosRelatedByRelacionusuarioScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->usuariosRelatedByRelacionusuarioScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getIdusuario();
                        $entryPk[1] = $entry->getIdusuario();
                        $pks[] = $entryPk;
                    }

                    \AmigosQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->usuariosRelatedByRelacionusuarioScheduledForDeletion = null;
                }

            }

            if ($this->collUsuariosRelatedByRelacionusuario) {
                foreach ($this->collUsuariosRelatedByRelacionusuario as $usuarioRelatedByRelacionusuario) {
                    if (!$usuarioRelatedByRelacionusuario->isDeleted() && ($usuarioRelatedByRelacionusuario->isNew() || $usuarioRelatedByRelacionusuario->isModified())) {
                        $usuarioRelatedByRelacionusuario->save($con);
                    }
                }
            }


            if ($this->usuariosRelatedByIdusuarioScheduledForDeletion !== null) {
                if (!$this->usuariosRelatedByIdusuarioScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->usuariosRelatedByIdusuarioScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getIdusuario();
                        $entryPk[0] = $entry->getIdusuario();
                        $pks[] = $entryPk;
                    }

                    \AmigosQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->usuariosRelatedByIdusuarioScheduledForDeletion = null;
                }

            }

            if ($this->collUsuariosRelatedByIdusuario) {
                foreach ($this->collUsuariosRelatedByIdusuario as $usuarioRelatedByIdusuario) {
                    if (!$usuarioRelatedByIdusuario->isDeleted() && ($usuarioRelatedByIdusuario->isNew() || $usuarioRelatedByIdusuario->isModified())) {
                        $usuarioRelatedByIdusuario->save($con);
                    }
                }
            }


            if ($this->viajesScheduledForDeletion !== null) {
                if (!$this->viajesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->viajesScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getIdusuario();
                        $entryPk[1] = $entry->getIdviaje();
                        $pks[] = $entryPk;
                    }

                    \ViajesQuery::create()
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


            if ($this->gruposScheduledForDeletion !== null) {
                if (!$this->gruposScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->gruposScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getIdusuario();
                        $entryPk[1] = $entry->getIdgrupo();
                        $pks[] = $entryPk;
                    }

                    \UsuarioGruposQuery::create()
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


            if ($this->amigossRelatedByIdusuarioScheduledForDeletion !== null) {
                if (!$this->amigossRelatedByIdusuarioScheduledForDeletion->isEmpty()) {
                    \AmigosQuery::create()
                        ->filterByPrimaryKeys($this->amigossRelatedByIdusuarioScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->amigossRelatedByIdusuarioScheduledForDeletion = null;
                }
            }

            if ($this->collAmigossRelatedByIdusuario !== null) {
                foreach ($this->collAmigossRelatedByIdusuario as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->amigossRelatedByRelacionusuarioScheduledForDeletion !== null) {
                if (!$this->amigossRelatedByRelacionusuarioScheduledForDeletion->isEmpty()) {
                    \AmigosQuery::create()
                        ->filterByPrimaryKeys($this->amigossRelatedByRelacionusuarioScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->amigossRelatedByRelacionusuarioScheduledForDeletion = null;
                }
            }

            if ($this->collAmigossRelatedByRelacionusuario !== null) {
                foreach ($this->collAmigossRelatedByRelacionusuario as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
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

            if ($this->invitacionsScheduledForDeletion !== null) {
                if (!$this->invitacionsScheduledForDeletion->isEmpty()) {
                    \InvitacionQuery::create()
                        ->filterByPrimaryKeys($this->invitacionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->invitacionsScheduledForDeletion = null;
                }
            }

            if ($this->collInvitacions !== null) {
                foreach ($this->collInvitacions as $referrerFK) {
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsuarioTableMap::COL_IDUSUARIO)) {
            $modifiedColumns[':p' . $index++]  = 'idusuario';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_AVATAR)) {
            $modifiedColumns[':p' . $index++]  = 'avatar';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = 'nombre';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_APELLIDOS)) {
            $modifiedColumns[':p' . $index++]  = 'apellidos';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_FKPERFIL)) {
            $modifiedColumns[':p' . $index++]  = 'fkperfil';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_DESCENDANT_CLASS)) {
            $modifiedColumns[':p' . $index++]  = 'descendant_class';
        }

        $sql = sprintf(
            'INSERT INTO Usuario (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'idusuario':                        
                        $stmt->bindValue($identifier, $this->idusuario, PDO::PARAM_STR);
                        break;
                    case 'password':                        
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case 'email':                        
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'avatar':                        
                        $stmt->bindValue($identifier, $this->avatar, PDO::PARAM_STR);
                        break;
                    case 'nombre':                        
                        $stmt->bindValue($identifier, $this->nombre, PDO::PARAM_STR);
                        break;
                    case 'apellidos':                        
                        $stmt->bindValue($identifier, $this->apellidos, PDO::PARAM_STR);
                        break;
                    case 'fkperfil':                        
                        $stmt->bindValue($identifier, $this->fkperfil, PDO::PARAM_INT);
                        break;
                    case 'descendant_class':                        
                        $stmt->bindValue($identifier, $this->descendant_class, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

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
        $pos = UsuarioTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdusuario();
                break;
            case 1:
                return $this->getPassword();
                break;
            case 2:
                return $this->getEmail();
                break;
            case 3:
                return $this->getAvatar();
                break;
            case 4:
                return $this->getNombre();
                break;
            case 5:
                return $this->getApellidos();
                break;
            case 6:
                return $this->getFkperfil();
                break;
            case 7:
                return $this->getDescendantClass();
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

        if (isset($alreadyDumpedObjects['Usuario'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Usuario'][$this->hashCode()] = true;
        $keys = UsuarioTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdusuario(),
            $keys[1] => $this->getPassword(),
            $keys[2] => $this->getEmail(),
            $keys[3] => $this->getAvatar(),
            $keys[4] => $this->getNombre(),
            $keys[5] => $this->getApellidos(),
            $keys[6] => $this->getFkperfil(),
            $keys[7] => $this->getDescendantClass(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->aPerfil) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'perfil';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Perfil';
                        break;
                    default:
                        $key = 'Perfil';
                }
        
                $result[$key] = $this->aPerfil->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAmigossRelatedByIdusuario) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'amigoss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'amigoss';
                        break;
                    default:
                        $key = 'Amigoss';
                }
        
                $result[$key] = $this->collAmigossRelatedByIdusuario->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAmigossRelatedByRelacionusuario) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'amigoss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'amigoss';
                        break;
                    default:
                        $key = 'Amigoss';
                }
        
                $result[$key] = $this->collAmigossRelatedByRelacionusuario->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
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
            if (null !== $this->collInvitacions) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'invitacions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Invitacions';
                        break;
                    default:
                        $key = 'Invitacions';
                }
        
                $result[$key] = $this->collInvitacions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Usuario
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsuarioTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Usuario
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdusuario($value);
                break;
            case 1:
                $this->setPassword($value);
                break;
            case 2:
                $this->setEmail($value);
                break;
            case 3:
                $this->setAvatar($value);
                break;
            case 4:
                $this->setNombre($value);
                break;
            case 5:
                $this->setApellidos($value);
                break;
            case 6:
                $this->setFkperfil($value);
                break;
            case 7:
                $this->setDescendantClass($value);
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
        $keys = UsuarioTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdusuario($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPassword($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmail($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAvatar($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNombre($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setApellidos($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setFkperfil($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDescendantClass($arr[$keys[7]]);
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
     * @return $this|\Usuario The current object, for fluid interface
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
        $criteria = new Criteria(UsuarioTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsuarioTableMap::COL_IDUSUARIO)) {
            $criteria->add(UsuarioTableMap::COL_IDUSUARIO, $this->idusuario);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_PASSWORD)) {
            $criteria->add(UsuarioTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_EMAIL)) {
            $criteria->add(UsuarioTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_AVATAR)) {
            $criteria->add(UsuarioTableMap::COL_AVATAR, $this->avatar);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_NOMBRE)) {
            $criteria->add(UsuarioTableMap::COL_NOMBRE, $this->nombre);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_APELLIDOS)) {
            $criteria->add(UsuarioTableMap::COL_APELLIDOS, $this->apellidos);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_FKPERFIL)) {
            $criteria->add(UsuarioTableMap::COL_FKPERFIL, $this->fkperfil);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_DESCENDANT_CLASS)) {
            $criteria->add(UsuarioTableMap::COL_DESCENDANT_CLASS, $this->descendant_class);
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
        $criteria = ChildUsuarioQuery::create();
        $criteria->add(UsuarioTableMap::COL_IDUSUARIO, $this->idusuario);

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
        $validPk = null !== $this->getIdusuario();

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
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getIdusuario();
    }

    /**
     * Generic method to set the primary key (idusuario column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdusuario($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdusuario();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Usuario (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdusuario($this->getIdusuario());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setAvatar($this->getAvatar());
        $copyObj->setNombre($this->getNombre());
        $copyObj->setApellidos($this->getApellidos());
        $copyObj->setFkperfil($this->getFkperfil());
        $copyObj->setDescendantClass($this->getDescendantClass());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAmigossRelatedByIdusuario() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAmigosRelatedByIdusuario($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAmigossRelatedByRelacionusuario() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAmigosRelatedByRelacionusuario($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getViajess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addViajes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsuarioGruposs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsuarioGrupos($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getInvitacions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addInvitacion($relObj->copy($deepCopy));
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
     * @return \Usuario Clone of current object.
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
     * Declares an association between this object and a ChildPerfil object.
     *
     * @param  ChildPerfil $v
     * @return $this|\Usuario The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPerfil(ChildPerfil $v = null)
    {
        if ($v === null) {
            $this->setFkperfil(NULL);
        } else {
            $this->setFkperfil($v->getIdperfil());
        }

        $this->aPerfil = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPerfil object, it will not be re-added.
        if ($v !== null) {
            $v->addUsuario($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPerfil object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPerfil The associated ChildPerfil object.
     * @throws PropelException
     */
    public function getPerfil(ConnectionInterface $con = null)
    {
        if ($this->aPerfil === null && ($this->fkperfil !== null)) {
            $this->aPerfil = ChildPerfilQuery::create()->findPk($this->fkperfil, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPerfil->addUsuarios($this);
             */
        }

        return $this->aPerfil;
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
        if ('AmigosRelatedByIdusuario' == $relationName) {
            return $this->initAmigossRelatedByIdusuario();
        }
        if ('AmigosRelatedByRelacionusuario' == $relationName) {
            return $this->initAmigossRelatedByRelacionusuario();
        }
        if ('Viajes' == $relationName) {
            return $this->initViajess();
        }
        if ('UsuarioGrupos' == $relationName) {
            return $this->initUsuarioGruposs();
        }
        if ('Invitacion' == $relationName) {
            return $this->initInvitacions();
        }
        if ('Administrador' == $relationName) {
            return $this->initAdministradors();
        }
        if ('Colaborador' == $relationName) {
            return $this->initColaboradors();
        }
    }

    /**
     * Clears out the collAmigossRelatedByIdusuario collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAmigossRelatedByIdusuario()
     */
    public function clearAmigossRelatedByIdusuario()
    {
        $this->collAmigossRelatedByIdusuario = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAmigossRelatedByIdusuario collection loaded partially.
     */
    public function resetPartialAmigossRelatedByIdusuario($v = true)
    {
        $this->collAmigossRelatedByIdusuarioPartial = $v;
    }

    /**
     * Initializes the collAmigossRelatedByIdusuario collection.
     *
     * By default this just sets the collAmigossRelatedByIdusuario collection to an empty array (like clearcollAmigossRelatedByIdusuario());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAmigossRelatedByIdusuario($overrideExisting = true)
    {
        if (null !== $this->collAmigossRelatedByIdusuario && !$overrideExisting) {
            return;
        }

        $collectionClassName = AmigosTableMap::getTableMap()->getCollectionClassName();

        $this->collAmigossRelatedByIdusuario = new $collectionClassName;
        $this->collAmigossRelatedByIdusuario->setModel('\Amigos');
    }

    /**
     * Gets an array of ChildAmigos objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAmigos[] List of ChildAmigos objects
     * @throws PropelException
     */
    public function getAmigossRelatedByIdusuario(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAmigossRelatedByIdusuarioPartial && !$this->isNew();
        if (null === $this->collAmigossRelatedByIdusuario || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAmigossRelatedByIdusuario) {
                // return empty collection
                $this->initAmigossRelatedByIdusuario();
            } else {
                $collAmigossRelatedByIdusuario = ChildAmigosQuery::create(null, $criteria)
                    ->filterByUsuarioRelatedByIdusuario($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAmigossRelatedByIdusuarioPartial && count($collAmigossRelatedByIdusuario)) {
                        $this->initAmigossRelatedByIdusuario(false);

                        foreach ($collAmigossRelatedByIdusuario as $obj) {
                            if (false == $this->collAmigossRelatedByIdusuario->contains($obj)) {
                                $this->collAmigossRelatedByIdusuario->append($obj);
                            }
                        }

                        $this->collAmigossRelatedByIdusuarioPartial = true;
                    }

                    return $collAmigossRelatedByIdusuario;
                }

                if ($partial && $this->collAmigossRelatedByIdusuario) {
                    foreach ($this->collAmigossRelatedByIdusuario as $obj) {
                        if ($obj->isNew()) {
                            $collAmigossRelatedByIdusuario[] = $obj;
                        }
                    }
                }

                $this->collAmigossRelatedByIdusuario = $collAmigossRelatedByIdusuario;
                $this->collAmigossRelatedByIdusuarioPartial = false;
            }
        }

        return $this->collAmigossRelatedByIdusuario;
    }

    /**
     * Sets a collection of ChildAmigos objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $amigossRelatedByIdusuario A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setAmigossRelatedByIdusuario(Collection $amigossRelatedByIdusuario, ConnectionInterface $con = null)
    {
        /** @var ChildAmigos[] $amigossRelatedByIdusuarioToDelete */
        $amigossRelatedByIdusuarioToDelete = $this->getAmigossRelatedByIdusuario(new Criteria(), $con)->diff($amigossRelatedByIdusuario);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->amigossRelatedByIdusuarioScheduledForDeletion = clone $amigossRelatedByIdusuarioToDelete;

        foreach ($amigossRelatedByIdusuarioToDelete as $amigosRelatedByIdusuarioRemoved) {
            $amigosRelatedByIdusuarioRemoved->setUsuarioRelatedByIdusuario(null);
        }

        $this->collAmigossRelatedByIdusuario = null;
        foreach ($amigossRelatedByIdusuario as $amigosRelatedByIdusuario) {
            $this->addAmigosRelatedByIdusuario($amigosRelatedByIdusuario);
        }

        $this->collAmigossRelatedByIdusuario = $amigossRelatedByIdusuario;
        $this->collAmigossRelatedByIdusuarioPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Amigos objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Amigos objects.
     * @throws PropelException
     */
    public function countAmigossRelatedByIdusuario(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAmigossRelatedByIdusuarioPartial && !$this->isNew();
        if (null === $this->collAmigossRelatedByIdusuario || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAmigossRelatedByIdusuario) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAmigossRelatedByIdusuario());
            }

            $query = ChildAmigosQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuarioRelatedByIdusuario($this)
                ->count($con);
        }

        return count($this->collAmigossRelatedByIdusuario);
    }

    /**
     * Method called to associate a ChildAmigos object to this object
     * through the ChildAmigos foreign key attribute.
     *
     * @param  ChildAmigos $l ChildAmigos
     * @return $this|\Usuario The current object (for fluent API support)
     */
    public function addAmigosRelatedByIdusuario(ChildAmigos $l)
    {
        if ($this->collAmigossRelatedByIdusuario === null) {
            $this->initAmigossRelatedByIdusuario();
            $this->collAmigossRelatedByIdusuarioPartial = true;
        }

        if (!$this->collAmigossRelatedByIdusuario->contains($l)) {
            $this->doAddAmigosRelatedByIdusuario($l);

            if ($this->amigossRelatedByIdusuarioScheduledForDeletion and $this->amigossRelatedByIdusuarioScheduledForDeletion->contains($l)) {
                $this->amigossRelatedByIdusuarioScheduledForDeletion->remove($this->amigossRelatedByIdusuarioScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAmigos $amigosRelatedByIdusuario The ChildAmigos object to add.
     */
    protected function doAddAmigosRelatedByIdusuario(ChildAmigos $amigosRelatedByIdusuario)
    {
        $this->collAmigossRelatedByIdusuario[]= $amigosRelatedByIdusuario;
        $amigosRelatedByIdusuario->setUsuarioRelatedByIdusuario($this);
    }

    /**
     * @param  ChildAmigos $amigosRelatedByIdusuario The ChildAmigos object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function removeAmigosRelatedByIdusuario(ChildAmigos $amigosRelatedByIdusuario)
    {
        if ($this->getAmigossRelatedByIdusuario()->contains($amigosRelatedByIdusuario)) {
            $pos = $this->collAmigossRelatedByIdusuario->search($amigosRelatedByIdusuario);
            $this->collAmigossRelatedByIdusuario->remove($pos);
            if (null === $this->amigossRelatedByIdusuarioScheduledForDeletion) {
                $this->amigossRelatedByIdusuarioScheduledForDeletion = clone $this->collAmigossRelatedByIdusuario;
                $this->amigossRelatedByIdusuarioScheduledForDeletion->clear();
            }
            $this->amigossRelatedByIdusuarioScheduledForDeletion[]= clone $amigosRelatedByIdusuario;
            $amigosRelatedByIdusuario->setUsuarioRelatedByIdusuario(null);
        }

        return $this;
    }

    /**
     * Clears out the collAmigossRelatedByRelacionusuario collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAmigossRelatedByRelacionusuario()
     */
    public function clearAmigossRelatedByRelacionusuario()
    {
        $this->collAmigossRelatedByRelacionusuario = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAmigossRelatedByRelacionusuario collection loaded partially.
     */
    public function resetPartialAmigossRelatedByRelacionusuario($v = true)
    {
        $this->collAmigossRelatedByRelacionusuarioPartial = $v;
    }

    /**
     * Initializes the collAmigossRelatedByRelacionusuario collection.
     *
     * By default this just sets the collAmigossRelatedByRelacionusuario collection to an empty array (like clearcollAmigossRelatedByRelacionusuario());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAmigossRelatedByRelacionusuario($overrideExisting = true)
    {
        if (null !== $this->collAmigossRelatedByRelacionusuario && !$overrideExisting) {
            return;
        }

        $collectionClassName = AmigosTableMap::getTableMap()->getCollectionClassName();

        $this->collAmigossRelatedByRelacionusuario = new $collectionClassName;
        $this->collAmigossRelatedByRelacionusuario->setModel('\Amigos');
    }

    /**
     * Gets an array of ChildAmigos objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAmigos[] List of ChildAmigos objects
     * @throws PropelException
     */
    public function getAmigossRelatedByRelacionusuario(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAmigossRelatedByRelacionusuarioPartial && !$this->isNew();
        if (null === $this->collAmigossRelatedByRelacionusuario || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAmigossRelatedByRelacionusuario) {
                // return empty collection
                $this->initAmigossRelatedByRelacionusuario();
            } else {
                $collAmigossRelatedByRelacionusuario = ChildAmigosQuery::create(null, $criteria)
                    ->filterByUsuarioRelatedByRelacionusuario($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAmigossRelatedByRelacionusuarioPartial && count($collAmigossRelatedByRelacionusuario)) {
                        $this->initAmigossRelatedByRelacionusuario(false);

                        foreach ($collAmigossRelatedByRelacionusuario as $obj) {
                            if (false == $this->collAmigossRelatedByRelacionusuario->contains($obj)) {
                                $this->collAmigossRelatedByRelacionusuario->append($obj);
                            }
                        }

                        $this->collAmigossRelatedByRelacionusuarioPartial = true;
                    }

                    return $collAmigossRelatedByRelacionusuario;
                }

                if ($partial && $this->collAmigossRelatedByRelacionusuario) {
                    foreach ($this->collAmigossRelatedByRelacionusuario as $obj) {
                        if ($obj->isNew()) {
                            $collAmigossRelatedByRelacionusuario[] = $obj;
                        }
                    }
                }

                $this->collAmigossRelatedByRelacionusuario = $collAmigossRelatedByRelacionusuario;
                $this->collAmigossRelatedByRelacionusuarioPartial = false;
            }
        }

        return $this->collAmigossRelatedByRelacionusuario;
    }

    /**
     * Sets a collection of ChildAmigos objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $amigossRelatedByRelacionusuario A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setAmigossRelatedByRelacionusuario(Collection $amigossRelatedByRelacionusuario, ConnectionInterface $con = null)
    {
        /** @var ChildAmigos[] $amigossRelatedByRelacionusuarioToDelete */
        $amigossRelatedByRelacionusuarioToDelete = $this->getAmigossRelatedByRelacionusuario(new Criteria(), $con)->diff($amigossRelatedByRelacionusuario);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->amigossRelatedByRelacionusuarioScheduledForDeletion = clone $amigossRelatedByRelacionusuarioToDelete;

        foreach ($amigossRelatedByRelacionusuarioToDelete as $amigosRelatedByRelacionusuarioRemoved) {
            $amigosRelatedByRelacionusuarioRemoved->setUsuarioRelatedByRelacionusuario(null);
        }

        $this->collAmigossRelatedByRelacionusuario = null;
        foreach ($amigossRelatedByRelacionusuario as $amigosRelatedByRelacionusuario) {
            $this->addAmigosRelatedByRelacionusuario($amigosRelatedByRelacionusuario);
        }

        $this->collAmigossRelatedByRelacionusuario = $amigossRelatedByRelacionusuario;
        $this->collAmigossRelatedByRelacionusuarioPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Amigos objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Amigos objects.
     * @throws PropelException
     */
    public function countAmigossRelatedByRelacionusuario(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAmigossRelatedByRelacionusuarioPartial && !$this->isNew();
        if (null === $this->collAmigossRelatedByRelacionusuario || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAmigossRelatedByRelacionusuario) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAmigossRelatedByRelacionusuario());
            }

            $query = ChildAmigosQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuarioRelatedByRelacionusuario($this)
                ->count($con);
        }

        return count($this->collAmigossRelatedByRelacionusuario);
    }

    /**
     * Method called to associate a ChildAmigos object to this object
     * through the ChildAmigos foreign key attribute.
     *
     * @param  ChildAmigos $l ChildAmigos
     * @return $this|\Usuario The current object (for fluent API support)
     */
    public function addAmigosRelatedByRelacionusuario(ChildAmigos $l)
    {
        if ($this->collAmigossRelatedByRelacionusuario === null) {
            $this->initAmigossRelatedByRelacionusuario();
            $this->collAmigossRelatedByRelacionusuarioPartial = true;
        }

        if (!$this->collAmigossRelatedByRelacionusuario->contains($l)) {
            $this->doAddAmigosRelatedByRelacionusuario($l);

            if ($this->amigossRelatedByRelacionusuarioScheduledForDeletion and $this->amigossRelatedByRelacionusuarioScheduledForDeletion->contains($l)) {
                $this->amigossRelatedByRelacionusuarioScheduledForDeletion->remove($this->amigossRelatedByRelacionusuarioScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAmigos $amigosRelatedByRelacionusuario The ChildAmigos object to add.
     */
    protected function doAddAmigosRelatedByRelacionusuario(ChildAmigos $amigosRelatedByRelacionusuario)
    {
        $this->collAmigossRelatedByRelacionusuario[]= $amigosRelatedByRelacionusuario;
        $amigosRelatedByRelacionusuario->setUsuarioRelatedByRelacionusuario($this);
    }

    /**
     * @param  ChildAmigos $amigosRelatedByRelacionusuario The ChildAmigos object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function removeAmigosRelatedByRelacionusuario(ChildAmigos $amigosRelatedByRelacionusuario)
    {
        if ($this->getAmigossRelatedByRelacionusuario()->contains($amigosRelatedByRelacionusuario)) {
            $pos = $this->collAmigossRelatedByRelacionusuario->search($amigosRelatedByRelacionusuario);
            $this->collAmigossRelatedByRelacionusuario->remove($pos);
            if (null === $this->amigossRelatedByRelacionusuarioScheduledForDeletion) {
                $this->amigossRelatedByRelacionusuarioScheduledForDeletion = clone $this->collAmigossRelatedByRelacionusuario;
                $this->amigossRelatedByRelacionusuarioScheduledForDeletion->clear();
            }
            $this->amigossRelatedByRelacionusuarioScheduledForDeletion[]= clone $amigosRelatedByRelacionusuario;
            $amigosRelatedByRelacionusuario->setUsuarioRelatedByRelacionusuario(null);
        }

        return $this;
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
     * If this ChildUsuario is new, it will return
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
                    ->filterByUsuario($this)
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
     * @return $this|ChildUsuario The current object (for fluent API support)
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
            $viajesRemoved->setUsuario(null);
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
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collViajess);
    }

    /**
     * Method called to associate a ChildViajes object to this object
     * through the ChildViajes foreign key attribute.
     *
     * @param  ChildViajes $l ChildViajes
     * @return $this|\Usuario The current object (for fluent API support)
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
        $viajes->setUsuario($this);
    }

    /**
     * @param  ChildViajes $viajes The ChildViajes object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
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
            $viajes->setUsuario(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Usuario is new, it will return
     * an empty collection; or if this Usuario has previously
     * been saved, it will retrieve related Viajess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Usuario.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildViajes[] List of ChildViajes objects
     */
    public function getViajessJoinViaje(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildViajesQuery::create(null, $criteria);
        $query->joinWith('Viaje', $joinBehavior);

        return $this->getViajess($query, $con);
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
     * If this ChildUsuario is new, it will return
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
                    ->filterByUsuario($this)
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
     * @return $this|ChildUsuario The current object (for fluent API support)
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
            $usuarioGruposRemoved->setUsuario(null);
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
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collUsuarioGruposs);
    }

    /**
     * Method called to associate a ChildUsuarioGrupos object to this object
     * through the ChildUsuarioGrupos foreign key attribute.
     *
     * @param  ChildUsuarioGrupos $l ChildUsuarioGrupos
     * @return $this|\Usuario The current object (for fluent API support)
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
        $usuarioGrupos->setUsuario($this);
    }

    /**
     * @param  ChildUsuarioGrupos $usuarioGrupos The ChildUsuarioGrupos object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
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
            $usuarioGrupos->setUsuario(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Usuario is new, it will return
     * an empty collection; or if this Usuario has previously
     * been saved, it will retrieve related UsuarioGruposs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Usuario.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUsuarioGrupos[] List of ChildUsuarioGrupos objects
     */
    public function getUsuarioGrupossJoinGrupo(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUsuarioGruposQuery::create(null, $criteria);
        $query->joinWith('Grupo', $joinBehavior);

        return $this->getUsuarioGruposs($query, $con);
    }

    /**
     * Clears out the collInvitacions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addInvitacions()
     */
    public function clearInvitacions()
    {
        $this->collInvitacions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collInvitacions collection loaded partially.
     */
    public function resetPartialInvitacions($v = true)
    {
        $this->collInvitacionsPartial = $v;
    }

    /**
     * Initializes the collInvitacions collection.
     *
     * By default this just sets the collInvitacions collection to an empty array (like clearcollInvitacions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initInvitacions($overrideExisting = true)
    {
        if (null !== $this->collInvitacions && !$overrideExisting) {
            return;
        }

        $collectionClassName = InvitacionTableMap::getTableMap()->getCollectionClassName();

        $this->collInvitacions = new $collectionClassName;
        $this->collInvitacions->setModel('\Invitacion');
    }

    /**
     * Gets an array of ChildInvitacion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildInvitacion[] List of ChildInvitacion objects
     * @throws PropelException
     */
    public function getInvitacions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collInvitacionsPartial && !$this->isNew();
        if (null === $this->collInvitacions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collInvitacions) {
                // return empty collection
                $this->initInvitacions();
            } else {
                $collInvitacions = ChildInvitacionQuery::create(null, $criteria)
                    ->filterByUsuario($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collInvitacionsPartial && count($collInvitacions)) {
                        $this->initInvitacions(false);

                        foreach ($collInvitacions as $obj) {
                            if (false == $this->collInvitacions->contains($obj)) {
                                $this->collInvitacions->append($obj);
                            }
                        }

                        $this->collInvitacionsPartial = true;
                    }

                    return $collInvitacions;
                }

                if ($partial && $this->collInvitacions) {
                    foreach ($this->collInvitacions as $obj) {
                        if ($obj->isNew()) {
                            $collInvitacions[] = $obj;
                        }
                    }
                }

                $this->collInvitacions = $collInvitacions;
                $this->collInvitacionsPartial = false;
            }
        }

        return $this->collInvitacions;
    }

    /**
     * Sets a collection of ChildInvitacion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $invitacions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setInvitacions(Collection $invitacions, ConnectionInterface $con = null)
    {
        /** @var ChildInvitacion[] $invitacionsToDelete */
        $invitacionsToDelete = $this->getInvitacions(new Criteria(), $con)->diff($invitacions);

        
        $this->invitacionsScheduledForDeletion = $invitacionsToDelete;

        foreach ($invitacionsToDelete as $invitacionRemoved) {
            $invitacionRemoved->setUsuario(null);
        }

        $this->collInvitacions = null;
        foreach ($invitacions as $invitacion) {
            $this->addInvitacion($invitacion);
        }

        $this->collInvitacions = $invitacions;
        $this->collInvitacionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Invitacion objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Invitacion objects.
     * @throws PropelException
     */
    public function countInvitacions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collInvitacionsPartial && !$this->isNew();
        if (null === $this->collInvitacions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collInvitacions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getInvitacions());
            }

            $query = ChildInvitacionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collInvitacions);
    }

    /**
     * Method called to associate a ChildInvitacion object to this object
     * through the ChildInvitacion foreign key attribute.
     *
     * @param  ChildInvitacion $l ChildInvitacion
     * @return $this|\Usuario The current object (for fluent API support)
     */
    public function addInvitacion(ChildInvitacion $l)
    {
        if ($this->collInvitacions === null) {
            $this->initInvitacions();
            $this->collInvitacionsPartial = true;
        }

        if (!$this->collInvitacions->contains($l)) {
            $this->doAddInvitacion($l);

            if ($this->invitacionsScheduledForDeletion and $this->invitacionsScheduledForDeletion->contains($l)) {
                $this->invitacionsScheduledForDeletion->remove($this->invitacionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildInvitacion $invitacion The ChildInvitacion object to add.
     */
    protected function doAddInvitacion(ChildInvitacion $invitacion)
    {
        $this->collInvitacions[]= $invitacion;
        $invitacion->setUsuario($this);
    }

    /**
     * @param  ChildInvitacion $invitacion The ChildInvitacion object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function removeInvitacion(ChildInvitacion $invitacion)
    {
        if ($this->getInvitacions()->contains($invitacion)) {
            $pos = $this->collInvitacions->search($invitacion);
            $this->collInvitacions->remove($pos);
            if (null === $this->invitacionsScheduledForDeletion) {
                $this->invitacionsScheduledForDeletion = clone $this->collInvitacions;
                $this->invitacionsScheduledForDeletion->clear();
            }
            $this->invitacionsScheduledForDeletion[]= clone $invitacion;
            $invitacion->setUsuario(null);
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
     * If this ChildUsuario is new, it will return
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
                    ->filterByUsuario($this)
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
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setAdministradors(Collection $administradors, ConnectionInterface $con = null)
    {
        /** @var ChildAdministrador[] $administradorsToDelete */
        $administradorsToDelete = $this->getAdministradors(new Criteria(), $con)->diff($administradors);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->administradorsScheduledForDeletion = clone $administradorsToDelete;

        foreach ($administradorsToDelete as $administradorRemoved) {
            $administradorRemoved->setUsuario(null);
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
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collAdministradors);
    }

    /**
     * Method called to associate a ChildAdministrador object to this object
     * through the ChildAdministrador foreign key attribute.
     *
     * @param  ChildAdministrador $l ChildAdministrador
     * @return $this|\Usuario The current object (for fluent API support)
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
        $administrador->setUsuario($this);
    }

    /**
     * @param  ChildAdministrador $administrador The ChildAdministrador object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
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
            $administrador->setUsuario(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Usuario is new, it will return
     * an empty collection; or if this Usuario has previously
     * been saved, it will retrieve related Administradors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Usuario.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAdministrador[] List of ChildAdministrador objects
     */
    public function getAdministradorsJoinPerfil(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAdministradorQuery::create(null, $criteria);
        $query->joinWith('Perfil', $joinBehavior);

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
     * If this ChildUsuario is new, it will return
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
                    ->filterByUsuario($this)
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
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setColaboradors(Collection $colaboradors, ConnectionInterface $con = null)
    {
        /** @var ChildColaborador[] $colaboradorsToDelete */
        $colaboradorsToDelete = $this->getColaboradors(new Criteria(), $con)->diff($colaboradors);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->colaboradorsScheduledForDeletion = clone $colaboradorsToDelete;

        foreach ($colaboradorsToDelete as $colaboradorRemoved) {
            $colaboradorRemoved->setUsuario(null);
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
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collColaboradors);
    }

    /**
     * Method called to associate a ChildColaborador object to this object
     * through the ChildColaborador foreign key attribute.
     *
     * @param  ChildColaborador $l ChildColaborador
     * @return $this|\Usuario The current object (for fluent API support)
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
        $colaborador->setUsuario($this);
    }

    /**
     * @param  ChildColaborador $colaborador The ChildColaborador object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
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
            $colaborador->setUsuario(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Usuario is new, it will return
     * an empty collection; or if this Usuario has previously
     * been saved, it will retrieve related Colaboradors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Usuario.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildColaborador[] List of ChildColaborador objects
     */
    public function getColaboradorsJoinPerfil(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildColaboradorQuery::create(null, $criteria);
        $query->joinWith('Perfil', $joinBehavior);

        return $this->getColaboradors($query, $con);
    }

    /**
     * Clears out the collUsuariosRelatedByRelacionusuario collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsuariosRelatedByRelacionusuario()
     */
    public function clearUsuariosRelatedByRelacionusuario()
    {
        $this->collUsuariosRelatedByRelacionusuario = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collUsuariosRelatedByRelacionusuario crossRef collection.
     *
     * By default this just sets the collUsuariosRelatedByRelacionusuario collection to an empty collection (like clearUsuariosRelatedByRelacionusuario());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initUsuariosRelatedByRelacionusuario()
    {
        $collectionClassName = AmigosTableMap::getTableMap()->getCollectionClassName();

        $this->collUsuariosRelatedByRelacionusuario = new $collectionClassName;
        $this->collUsuariosRelatedByRelacionusuarioPartial = true;
        $this->collUsuariosRelatedByRelacionusuario->setModel('\Usuario');
    }

    /**
     * Checks if the collUsuariosRelatedByRelacionusuario collection is loaded.
     *
     * @return bool
     */
    public function isUsuariosRelatedByRelacionusuarioLoaded()
    {
        return null !== $this->collUsuariosRelatedByRelacionusuario;
    }

    /**
     * Gets a collection of ChildUsuario objects related by a many-to-many relationship
     * to the current object by way of the amigos cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildUsuario[] List of ChildUsuario objects
     */
    public function getUsuariosRelatedByRelacionusuario(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUsuariosRelatedByRelacionusuarioPartial && !$this->isNew();
        if (null === $this->collUsuariosRelatedByRelacionusuario || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collUsuariosRelatedByRelacionusuario) {
                    $this->initUsuariosRelatedByRelacionusuario();
                }
            } else {

                $query = ChildUsuarioQuery::create(null, $criteria)
                    ->filterByUsuarioRelatedByIdusuario($this);
                $collUsuariosRelatedByRelacionusuario = $query->find($con);
                if (null !== $criteria) {
                    return $collUsuariosRelatedByRelacionusuario;
                }

                if ($partial && $this->collUsuariosRelatedByRelacionusuario) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collUsuariosRelatedByRelacionusuario as $obj) {
                        if (!$collUsuariosRelatedByRelacionusuario->contains($obj)) {
                            $collUsuariosRelatedByRelacionusuario[] = $obj;
                        }
                    }
                }

                $this->collUsuariosRelatedByRelacionusuario = $collUsuariosRelatedByRelacionusuario;
                $this->collUsuariosRelatedByRelacionusuarioPartial = false;
            }
        }

        return $this->collUsuariosRelatedByRelacionusuario;
    }

    /**
     * Sets a collection of Usuario objects related by a many-to-many relationship
     * to the current object by way of the amigos cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $usuariosRelatedByRelacionusuario A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setUsuariosRelatedByRelacionusuario(Collection $usuariosRelatedByRelacionusuario, ConnectionInterface $con = null)
    {
        $this->clearUsuariosRelatedByRelacionusuario();
        $currentUsuariosRelatedByRelacionusuario = $this->getUsuariosRelatedByRelacionusuario();

        $usuariosRelatedByRelacionusuarioScheduledForDeletion = $currentUsuariosRelatedByRelacionusuario->diff($usuariosRelatedByRelacionusuario);

        foreach ($usuariosRelatedByRelacionusuarioScheduledForDeletion as $toDelete) {
            $this->removeUsuarioRelatedByRelacionusuario($toDelete);
        }

        foreach ($usuariosRelatedByRelacionusuario as $usuarioRelatedByRelacionusuario) {
            if (!$currentUsuariosRelatedByRelacionusuario->contains($usuarioRelatedByRelacionusuario)) {
                $this->doAddUsuarioRelatedByRelacionusuario($usuarioRelatedByRelacionusuario);
            }
        }

        $this->collUsuariosRelatedByRelacionusuarioPartial = false;
        $this->collUsuariosRelatedByRelacionusuario = $usuariosRelatedByRelacionusuario;

        return $this;
    }

    /**
     * Gets the number of Usuario objects related by a many-to-many relationship
     * to the current object by way of the amigos cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Usuario objects
     */
    public function countUsuariosRelatedByRelacionusuario(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUsuariosRelatedByRelacionusuarioPartial && !$this->isNew();
        if (null === $this->collUsuariosRelatedByRelacionusuario || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsuariosRelatedByRelacionusuario) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getUsuariosRelatedByRelacionusuario());
                }

                $query = ChildUsuarioQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUsuarioRelatedByIdusuario($this)
                    ->count($con);
            }
        } else {
            return count($this->collUsuariosRelatedByRelacionusuario);
        }
    }

    /**
     * Associate a ChildUsuario to this object
     * through the amigos cross reference table.
     * 
     * @param ChildUsuario $usuarioRelatedByRelacionusuario
     * @return ChildUsuario The current object (for fluent API support)
     */
    public function addUsuarioRelatedByRelacionusuario(ChildUsuario $usuarioRelatedByRelacionusuario)
    {
        if ($this->collUsuariosRelatedByRelacionusuario === null) {
            $this->initUsuariosRelatedByRelacionusuario();
        }

        if (!$this->getUsuariosRelatedByRelacionusuario()->contains($usuarioRelatedByRelacionusuario)) {
            // only add it if the **same** object is not already associated
            $this->collUsuariosRelatedByRelacionusuario->push($usuarioRelatedByRelacionusuario);
            $this->doAddUsuarioRelatedByRelacionusuario($usuarioRelatedByRelacionusuario);
        }

        return $this;
    }

    /**
     * 
     * @param ChildUsuario $usuarioRelatedByRelacionusuario
     */
    protected function doAddUsuarioRelatedByRelacionusuario(ChildUsuario $usuarioRelatedByRelacionusuario)
    {
        $amigos = new ChildAmigos();

        $amigos->setUsuarioRelatedByRelacionusuario($usuarioRelatedByRelacionusuario);

        $amigos->setUsuarioRelatedByIdusuario($this);

        $this->addAmigosRelatedByIdusuario($amigos);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$usuarioRelatedByRelacionusuario->isUsuariosRelatedByIdusuarioLoaded()) {
            $usuarioRelatedByRelacionusuario->initUsuariosRelatedByIdusuario();
            $usuarioRelatedByRelacionusuario->getUsuariosRelatedByIdusuario()->push($this);
        } elseif (!$usuarioRelatedByRelacionusuario->getUsuariosRelatedByIdusuario()->contains($this)) {
            $usuarioRelatedByRelacionusuario->getUsuariosRelatedByIdusuario()->push($this);
        }

    }

    /**
     * Remove usuarioRelatedByRelacionusuario of this object
     * through the amigos cross reference table.
     * 
     * @param ChildUsuario $usuarioRelatedByRelacionusuario
     * @return ChildUsuario The current object (for fluent API support)
     */
    public function removeUsuarioRelatedByRelacionusuario(ChildUsuario $usuarioRelatedByRelacionusuario)
    {
        if ($this->getUsuariosRelatedByRelacionusuario()->contains($usuarioRelatedByRelacionusuario)) { $amigos = new ChildAmigos();

            $amigos->setUsuarioRelatedByRelacionusuario($usuarioRelatedByRelacionusuario);
            if ($usuarioRelatedByRelacionusuario->isUsuarioRelatedByIdusuariosLoaded()) {
                //remove the back reference if available
                $usuarioRelatedByRelacionusuario->getUsuarioRelatedByIdusuarios()->removeObject($this);
            }

            $amigos->setUsuarioRelatedByIdusuario($this);
            $this->removeAmigosRelatedByIdusuario(clone $amigos);
            $amigos->clear();

            $this->collUsuariosRelatedByRelacionusuario->remove($this->collUsuariosRelatedByRelacionusuario->search($usuarioRelatedByRelacionusuario));
            
            if (null === $this->usuariosRelatedByRelacionusuarioScheduledForDeletion) {
                $this->usuariosRelatedByRelacionusuarioScheduledForDeletion = clone $this->collUsuariosRelatedByRelacionusuario;
                $this->usuariosRelatedByRelacionusuarioScheduledForDeletion->clear();
            }

            $this->usuariosRelatedByRelacionusuarioScheduledForDeletion->push($usuarioRelatedByRelacionusuario);
        }


        return $this;
    }

    /**
     * Clears out the collUsuariosRelatedByIdusuario collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsuariosRelatedByIdusuario()
     */
    public function clearUsuariosRelatedByIdusuario()
    {
        $this->collUsuariosRelatedByIdusuario = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collUsuariosRelatedByIdusuario crossRef collection.
     *
     * By default this just sets the collUsuariosRelatedByIdusuario collection to an empty collection (like clearUsuariosRelatedByIdusuario());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initUsuariosRelatedByIdusuario()
    {
        $collectionClassName = AmigosTableMap::getTableMap()->getCollectionClassName();

        $this->collUsuariosRelatedByIdusuario = new $collectionClassName;
        $this->collUsuariosRelatedByIdusuarioPartial = true;
        $this->collUsuariosRelatedByIdusuario->setModel('\Usuario');
    }

    /**
     * Checks if the collUsuariosRelatedByIdusuario collection is loaded.
     *
     * @return bool
     */
    public function isUsuariosRelatedByIdusuarioLoaded()
    {
        return null !== $this->collUsuariosRelatedByIdusuario;
    }

    /**
     * Gets a collection of ChildUsuario objects related by a many-to-many relationship
     * to the current object by way of the amigos cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildUsuario[] List of ChildUsuario objects
     */
    public function getUsuariosRelatedByIdusuario(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUsuariosRelatedByIdusuarioPartial && !$this->isNew();
        if (null === $this->collUsuariosRelatedByIdusuario || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collUsuariosRelatedByIdusuario) {
                    $this->initUsuariosRelatedByIdusuario();
                }
            } else {

                $query = ChildUsuarioQuery::create(null, $criteria)
                    ->filterByUsuarioRelatedByRelacionusuario($this);
                $collUsuariosRelatedByIdusuario = $query->find($con);
                if (null !== $criteria) {
                    return $collUsuariosRelatedByIdusuario;
                }

                if ($partial && $this->collUsuariosRelatedByIdusuario) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collUsuariosRelatedByIdusuario as $obj) {
                        if (!$collUsuariosRelatedByIdusuario->contains($obj)) {
                            $collUsuariosRelatedByIdusuario[] = $obj;
                        }
                    }
                }

                $this->collUsuariosRelatedByIdusuario = $collUsuariosRelatedByIdusuario;
                $this->collUsuariosRelatedByIdusuarioPartial = false;
            }
        }

        return $this->collUsuariosRelatedByIdusuario;
    }

    /**
     * Sets a collection of Usuario objects related by a many-to-many relationship
     * to the current object by way of the amigos cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $usuariosRelatedByIdusuario A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setUsuariosRelatedByIdusuario(Collection $usuariosRelatedByIdusuario, ConnectionInterface $con = null)
    {
        $this->clearUsuariosRelatedByIdusuario();
        $currentUsuariosRelatedByIdusuario = $this->getUsuariosRelatedByIdusuario();

        $usuariosRelatedByIdusuarioScheduledForDeletion = $currentUsuariosRelatedByIdusuario->diff($usuariosRelatedByIdusuario);

        foreach ($usuariosRelatedByIdusuarioScheduledForDeletion as $toDelete) {
            $this->removeUsuarioRelatedByIdusuario($toDelete);
        }

        foreach ($usuariosRelatedByIdusuario as $usuarioRelatedByIdusuario) {
            if (!$currentUsuariosRelatedByIdusuario->contains($usuarioRelatedByIdusuario)) {
                $this->doAddUsuarioRelatedByIdusuario($usuarioRelatedByIdusuario);
            }
        }

        $this->collUsuariosRelatedByIdusuarioPartial = false;
        $this->collUsuariosRelatedByIdusuario = $usuariosRelatedByIdusuario;

        return $this;
    }

    /**
     * Gets the number of Usuario objects related by a many-to-many relationship
     * to the current object by way of the amigos cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Usuario objects
     */
    public function countUsuariosRelatedByIdusuario(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUsuariosRelatedByIdusuarioPartial && !$this->isNew();
        if (null === $this->collUsuariosRelatedByIdusuario || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsuariosRelatedByIdusuario) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getUsuariosRelatedByIdusuario());
                }

                $query = ChildUsuarioQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUsuarioRelatedByRelacionusuario($this)
                    ->count($con);
            }
        } else {
            return count($this->collUsuariosRelatedByIdusuario);
        }
    }

    /**
     * Associate a ChildUsuario to this object
     * through the amigos cross reference table.
     * 
     * @param ChildUsuario $usuarioRelatedByIdusuario
     * @return ChildUsuario The current object (for fluent API support)
     */
    public function addUsuarioRelatedByIdusuario(ChildUsuario $usuarioRelatedByIdusuario)
    {
        if ($this->collUsuariosRelatedByIdusuario === null) {
            $this->initUsuariosRelatedByIdusuario();
        }

        if (!$this->getUsuariosRelatedByIdusuario()->contains($usuarioRelatedByIdusuario)) {
            // only add it if the **same** object is not already associated
            $this->collUsuariosRelatedByIdusuario->push($usuarioRelatedByIdusuario);
            $this->doAddUsuarioRelatedByIdusuario($usuarioRelatedByIdusuario);
        }

        return $this;
    }

    /**
     * 
     * @param ChildUsuario $usuarioRelatedByIdusuario
     */
    protected function doAddUsuarioRelatedByIdusuario(ChildUsuario $usuarioRelatedByIdusuario)
    {
        $amigos = new ChildAmigos();

        $amigos->setUsuarioRelatedByIdusuario($usuarioRelatedByIdusuario);

        $amigos->setUsuarioRelatedByRelacionusuario($this);

        $this->addAmigosRelatedByRelacionusuario($amigos);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$usuarioRelatedByIdusuario->isUsuariosRelatedByRelacionusuarioLoaded()) {
            $usuarioRelatedByIdusuario->initUsuariosRelatedByRelacionusuario();
            $usuarioRelatedByIdusuario->getUsuariosRelatedByRelacionusuario()->push($this);
        } elseif (!$usuarioRelatedByIdusuario->getUsuariosRelatedByRelacionusuario()->contains($this)) {
            $usuarioRelatedByIdusuario->getUsuariosRelatedByRelacionusuario()->push($this);
        }

    }

    /**
     * Remove usuarioRelatedByIdusuario of this object
     * through the amigos cross reference table.
     * 
     * @param ChildUsuario $usuarioRelatedByIdusuario
     * @return ChildUsuario The current object (for fluent API support)
     */
    public function removeUsuarioRelatedByIdusuario(ChildUsuario $usuarioRelatedByIdusuario)
    {
        if ($this->getUsuariosRelatedByIdusuario()->contains($usuarioRelatedByIdusuario)) { $amigos = new ChildAmigos();

            $amigos->setUsuarioRelatedByIdusuario($usuarioRelatedByIdusuario);
            if ($usuarioRelatedByIdusuario->isUsuarioRelatedByRelacionusuariosLoaded()) {
                //remove the back reference if available
                $usuarioRelatedByIdusuario->getUsuarioRelatedByRelacionusuarios()->removeObject($this);
            }

            $amigos->setUsuarioRelatedByRelacionusuario($this);
            $this->removeAmigosRelatedByRelacionusuario(clone $amigos);
            $amigos->clear();

            $this->collUsuariosRelatedByIdusuario->remove($this->collUsuariosRelatedByIdusuario->search($usuarioRelatedByIdusuario));
            
            if (null === $this->usuariosRelatedByIdusuarioScheduledForDeletion) {
                $this->usuariosRelatedByIdusuarioScheduledForDeletion = clone $this->collUsuariosRelatedByIdusuario;
                $this->usuariosRelatedByIdusuarioScheduledForDeletion->clear();
            }

            $this->usuariosRelatedByIdusuarioScheduledForDeletion->push($usuarioRelatedByIdusuario);
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
        $collectionClassName = ViajesTableMap::getTableMap()->getCollectionClassName();

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
     * to the current object by way of the viajes cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
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
                    ->filterByUsuario($this);
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
     * to the current object by way of the viajes cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $viajes A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
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
     * to the current object by way of the viajes cross-reference table.
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
                    ->filterByUsuario($this)
                    ->count($con);
            }
        } else {
            return count($this->collViajes);
        }
    }

    /**
     * Associate a ChildViaje to this object
     * through the viajes cross reference table.
     * 
     * @param ChildViaje $viaje
     * @return ChildUsuario The current object (for fluent API support)
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
        $viajes = new ChildViajes();

        $viajes->setViaje($viaje);

        $viajes->setUsuario($this);

        $this->addViajes($viajes);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$viaje->isUsuariosLoaded()) {
            $viaje->initUsuarios();
            $viaje->getUsuarios()->push($this);
        } elseif (!$viaje->getUsuarios()->contains($this)) {
            $viaje->getUsuarios()->push($this);
        }

    }

    /**
     * Remove viaje of this object
     * through the viajes cross reference table.
     * 
     * @param ChildViaje $viaje
     * @return ChildUsuario The current object (for fluent API support)
     */
    public function removeViaje(ChildViaje $viaje)
    {
        if ($this->getViajes()->contains($viaje)) { $viajes = new ChildViajes();

            $viajes->setViaje($viaje);
            if ($viaje->isUsuariosLoaded()) {
                //remove the back reference if available
                $viaje->getUsuarios()->removeObject($this);
            }

            $viajes->setUsuario($this);
            $this->removeViajes(clone $viajes);
            $viajes->clear();

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
        $collectionClassName = UsuarioGruposTableMap::getTableMap()->getCollectionClassName();

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
     * to the current object by way of the Usuario_grupos cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
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
                    ->filterByUsuario($this);
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
     * to the current object by way of the Usuario_grupos cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $grupos A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
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
     * to the current object by way of the Usuario_grupos cross-reference table.
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
                    ->filterByUsuario($this)
                    ->count($con);
            }
        } else {
            return count($this->collGrupos);
        }
    }

    /**
     * Associate a ChildGrupo to this object
     * through the Usuario_grupos cross reference table.
     * 
     * @param ChildGrupo $grupo
     * @return ChildUsuario The current object (for fluent API support)
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
        $usuarioGrupos = new ChildUsuarioGrupos();

        $usuarioGrupos->setGrupo($grupo);

        $usuarioGrupos->setUsuario($this);

        $this->addUsuarioGrupos($usuarioGrupos);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$grupo->isUsuariosLoaded()) {
            $grupo->initUsuarios();
            $grupo->getUsuarios()->push($this);
        } elseif (!$grupo->getUsuarios()->contains($this)) {
            $grupo->getUsuarios()->push($this);
        }

    }

    /**
     * Remove grupo of this object
     * through the Usuario_grupos cross reference table.
     * 
     * @param ChildGrupo $grupo
     * @return ChildUsuario The current object (for fluent API support)
     */
    public function removeGrupo(ChildGrupo $grupo)
    {
        if ($this->getGrupos()->contains($grupo)) { $usuarioGrupos = new ChildUsuarioGrupos();

            $usuarioGrupos->setGrupo($grupo);
            if ($grupo->isUsuariosLoaded()) {
                //remove the back reference if available
                $grupo->getUsuarios()->removeObject($this);
            }

            $usuarioGrupos->setUsuario($this);
            $this->removeUsuarioGrupos(clone $usuarioGrupos);
            $usuarioGrupos->clear();

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
        if (null !== $this->aPerfil) {
            $this->aPerfil->removeUsuario($this);
        }
        $this->idusuario = null;
        $this->password = null;
        $this->email = null;
        $this->avatar = null;
        $this->nombre = null;
        $this->apellidos = null;
        $this->fkperfil = null;
        $this->descendant_class = null;
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
            if ($this->collAmigossRelatedByIdusuario) {
                foreach ($this->collAmigossRelatedByIdusuario as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAmigossRelatedByRelacionusuario) {
                foreach ($this->collAmigossRelatedByRelacionusuario as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collViajess) {
                foreach ($this->collViajess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsuarioGruposs) {
                foreach ($this->collUsuarioGruposs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collInvitacions) {
                foreach ($this->collInvitacions as $o) {
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
            if ($this->collUsuariosRelatedByRelacionusuario) {
                foreach ($this->collUsuariosRelatedByRelacionusuario as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsuariosRelatedByIdusuario) {
                foreach ($this->collUsuariosRelatedByIdusuario as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collViajes) {
                foreach ($this->collViajes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGrupos) {
                foreach ($this->collGrupos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAmigossRelatedByIdusuario = null;
        $this->collAmigossRelatedByRelacionusuario = null;
        $this->collViajess = null;
        $this->collUsuarioGruposs = null;
        $this->collInvitacions = null;
        $this->collAdministradors = null;
        $this->collColaboradors = null;
        $this->collUsuariosRelatedByRelacionusuario = null;
        $this->collUsuariosRelatedByIdusuario = null;
        $this->collViajes = null;
        $this->collGrupos = null;
        $this->aPerfil = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsuarioTableMap::DEFAULT_STRING_FORMAT);
    }

    // concrete_inheritance_parent behavior
    
    /**
     * Whether or not this object is the parent of a child object
     *
     * @return    bool
     */
    public function hasChildObject()
    {
        return $this->getDescendantClass() !== null;
    }
    
    /**
     * Get the child object of this object
     *
     * @return    mixed
     */
    public function getChildObject()
    {
        if (!$this->hasChildObject()) {
            return null;
        }
        $childObjectClass = $this->getDescendantClass();
        $childObject = PropelQuery::from($childObjectClass)->findPk($this->getPrimaryKey());
    
        return $childObject->hasChildObject() ? $childObject->getChildObject() : $childObject;
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
