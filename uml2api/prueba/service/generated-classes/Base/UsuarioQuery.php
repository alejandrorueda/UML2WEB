<?php

namespace Base;

use \Usuario as ChildUsuario;
use \UsuarioQuery as ChildUsuarioQuery;
use \Exception;
use \PDO;
use Map\UsuarioTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Usuario' table.
 *
 * 
 *
 * @method     ChildUsuarioQuery orderByIdusuario($order = Criteria::ASC) Order by the idusuario column
 * @method     ChildUsuarioQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUsuarioQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsuarioQuery orderByAvatar($order = Criteria::ASC) Order by the avatar column
 * @method     ChildUsuarioQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 * @method     ChildUsuarioQuery orderByApellidos($order = Criteria::ASC) Order by the apellidos column
 * @method     ChildUsuarioQuery orderByFkperfil($order = Criteria::ASC) Order by the fkperfil column
 * @method     ChildUsuarioQuery orderByDescendantClass($order = Criteria::ASC) Order by the descendant_class column
 *
 * @method     ChildUsuarioQuery groupByIdusuario() Group by the idusuario column
 * @method     ChildUsuarioQuery groupByPassword() Group by the password column
 * @method     ChildUsuarioQuery groupByEmail() Group by the email column
 * @method     ChildUsuarioQuery groupByAvatar() Group by the avatar column
 * @method     ChildUsuarioQuery groupByNombre() Group by the nombre column
 * @method     ChildUsuarioQuery groupByApellidos() Group by the apellidos column
 * @method     ChildUsuarioQuery groupByFkperfil() Group by the fkperfil column
 * @method     ChildUsuarioQuery groupByDescendantClass() Group by the descendant_class column
 *
 * @method     ChildUsuarioQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsuarioQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsuarioQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsuarioQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsuarioQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsuarioQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsuarioQuery leftJoinPerfil($relationAlias = null) Adds a LEFT JOIN clause to the query using the Perfil relation
 * @method     ChildUsuarioQuery rightJoinPerfil($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Perfil relation
 * @method     ChildUsuarioQuery innerJoinPerfil($relationAlias = null) Adds a INNER JOIN clause to the query using the Perfil relation
 *
 * @method     ChildUsuarioQuery joinWithPerfil($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Perfil relation
 *
 * @method     ChildUsuarioQuery leftJoinWithPerfil() Adds a LEFT JOIN clause and with to the query using the Perfil relation
 * @method     ChildUsuarioQuery rightJoinWithPerfil() Adds a RIGHT JOIN clause and with to the query using the Perfil relation
 * @method     ChildUsuarioQuery innerJoinWithPerfil() Adds a INNER JOIN clause and with to the query using the Perfil relation
 *
 * @method     ChildUsuarioQuery leftJoinAmigosRelatedByIdusuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the AmigosRelatedByIdusuario relation
 * @method     ChildUsuarioQuery rightJoinAmigosRelatedByIdusuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AmigosRelatedByIdusuario relation
 * @method     ChildUsuarioQuery innerJoinAmigosRelatedByIdusuario($relationAlias = null) Adds a INNER JOIN clause to the query using the AmigosRelatedByIdusuario relation
 *
 * @method     ChildUsuarioQuery joinWithAmigosRelatedByIdusuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AmigosRelatedByIdusuario relation
 *
 * @method     ChildUsuarioQuery leftJoinWithAmigosRelatedByIdusuario() Adds a LEFT JOIN clause and with to the query using the AmigosRelatedByIdusuario relation
 * @method     ChildUsuarioQuery rightJoinWithAmigosRelatedByIdusuario() Adds a RIGHT JOIN clause and with to the query using the AmigosRelatedByIdusuario relation
 * @method     ChildUsuarioQuery innerJoinWithAmigosRelatedByIdusuario() Adds a INNER JOIN clause and with to the query using the AmigosRelatedByIdusuario relation
 *
 * @method     ChildUsuarioQuery leftJoinAmigosRelatedByRelacionusuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the AmigosRelatedByRelacionusuario relation
 * @method     ChildUsuarioQuery rightJoinAmigosRelatedByRelacionusuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AmigosRelatedByRelacionusuario relation
 * @method     ChildUsuarioQuery innerJoinAmigosRelatedByRelacionusuario($relationAlias = null) Adds a INNER JOIN clause to the query using the AmigosRelatedByRelacionusuario relation
 *
 * @method     ChildUsuarioQuery joinWithAmigosRelatedByRelacionusuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AmigosRelatedByRelacionusuario relation
 *
 * @method     ChildUsuarioQuery leftJoinWithAmigosRelatedByRelacionusuario() Adds a LEFT JOIN clause and with to the query using the AmigosRelatedByRelacionusuario relation
 * @method     ChildUsuarioQuery rightJoinWithAmigosRelatedByRelacionusuario() Adds a RIGHT JOIN clause and with to the query using the AmigosRelatedByRelacionusuario relation
 * @method     ChildUsuarioQuery innerJoinWithAmigosRelatedByRelacionusuario() Adds a INNER JOIN clause and with to the query using the AmigosRelatedByRelacionusuario relation
 *
 * @method     ChildUsuarioQuery leftJoinViajes($relationAlias = null) Adds a LEFT JOIN clause to the query using the Viajes relation
 * @method     ChildUsuarioQuery rightJoinViajes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Viajes relation
 * @method     ChildUsuarioQuery innerJoinViajes($relationAlias = null) Adds a INNER JOIN clause to the query using the Viajes relation
 *
 * @method     ChildUsuarioQuery joinWithViajes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Viajes relation
 *
 * @method     ChildUsuarioQuery leftJoinWithViajes() Adds a LEFT JOIN clause and with to the query using the Viajes relation
 * @method     ChildUsuarioQuery rightJoinWithViajes() Adds a RIGHT JOIN clause and with to the query using the Viajes relation
 * @method     ChildUsuarioQuery innerJoinWithViajes() Adds a INNER JOIN clause and with to the query using the Viajes relation
 *
 * @method     ChildUsuarioQuery leftJoinUsuarioGrupos($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioGrupos relation
 * @method     ChildUsuarioQuery rightJoinUsuarioGrupos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioGrupos relation
 * @method     ChildUsuarioQuery innerJoinUsuarioGrupos($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioGrupos relation
 *
 * @method     ChildUsuarioQuery joinWithUsuarioGrupos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsuarioGrupos relation
 *
 * @method     ChildUsuarioQuery leftJoinWithUsuarioGrupos() Adds a LEFT JOIN clause and with to the query using the UsuarioGrupos relation
 * @method     ChildUsuarioQuery rightJoinWithUsuarioGrupos() Adds a RIGHT JOIN clause and with to the query using the UsuarioGrupos relation
 * @method     ChildUsuarioQuery innerJoinWithUsuarioGrupos() Adds a INNER JOIN clause and with to the query using the UsuarioGrupos relation
 *
 * @method     ChildUsuarioQuery leftJoinInvitacion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Invitacion relation
 * @method     ChildUsuarioQuery rightJoinInvitacion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Invitacion relation
 * @method     ChildUsuarioQuery innerJoinInvitacion($relationAlias = null) Adds a INNER JOIN clause to the query using the Invitacion relation
 *
 * @method     ChildUsuarioQuery joinWithInvitacion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Invitacion relation
 *
 * @method     ChildUsuarioQuery leftJoinWithInvitacion() Adds a LEFT JOIN clause and with to the query using the Invitacion relation
 * @method     ChildUsuarioQuery rightJoinWithInvitacion() Adds a RIGHT JOIN clause and with to the query using the Invitacion relation
 * @method     ChildUsuarioQuery innerJoinWithInvitacion() Adds a INNER JOIN clause and with to the query using the Invitacion relation
 *
 * @method     ChildUsuarioQuery leftJoinAdministrador($relationAlias = null) Adds a LEFT JOIN clause to the query using the Administrador relation
 * @method     ChildUsuarioQuery rightJoinAdministrador($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Administrador relation
 * @method     ChildUsuarioQuery innerJoinAdministrador($relationAlias = null) Adds a INNER JOIN clause to the query using the Administrador relation
 *
 * @method     ChildUsuarioQuery joinWithAdministrador($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Administrador relation
 *
 * @method     ChildUsuarioQuery leftJoinWithAdministrador() Adds a LEFT JOIN clause and with to the query using the Administrador relation
 * @method     ChildUsuarioQuery rightJoinWithAdministrador() Adds a RIGHT JOIN clause and with to the query using the Administrador relation
 * @method     ChildUsuarioQuery innerJoinWithAdministrador() Adds a INNER JOIN clause and with to the query using the Administrador relation
 *
 * @method     ChildUsuarioQuery leftJoinColaborador($relationAlias = null) Adds a LEFT JOIN clause to the query using the Colaborador relation
 * @method     ChildUsuarioQuery rightJoinColaborador($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Colaborador relation
 * @method     ChildUsuarioQuery innerJoinColaborador($relationAlias = null) Adds a INNER JOIN clause to the query using the Colaborador relation
 *
 * @method     ChildUsuarioQuery joinWithColaborador($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Colaborador relation
 *
 * @method     ChildUsuarioQuery leftJoinWithColaborador() Adds a LEFT JOIN clause and with to the query using the Colaborador relation
 * @method     ChildUsuarioQuery rightJoinWithColaborador() Adds a RIGHT JOIN clause and with to the query using the Colaborador relation
 * @method     ChildUsuarioQuery innerJoinWithColaborador() Adds a INNER JOIN clause and with to the query using the Colaborador relation
 *
 * @method     \PerfilQuery|\AmigosQuery|\ViajesQuery|\UsuarioGruposQuery|\InvitacionQuery|\AdministradorQuery|\ColaboradorQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsuario findOne(ConnectionInterface $con = null) Return the first ChildUsuario matching the query
 * @method     ChildUsuario findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsuario matching the query, or a new ChildUsuario object populated from the query conditions when no match is found
 *
 * @method     ChildUsuario findOneByIdusuario(string $idusuario) Return the first ChildUsuario filtered by the idusuario column
 * @method     ChildUsuario findOneByPassword(string $password) Return the first ChildUsuario filtered by the password column
 * @method     ChildUsuario findOneByEmail(string $email) Return the first ChildUsuario filtered by the email column
 * @method     ChildUsuario findOneByAvatar(string $avatar) Return the first ChildUsuario filtered by the avatar column
 * @method     ChildUsuario findOneByNombre(string $nombre) Return the first ChildUsuario filtered by the nombre column
 * @method     ChildUsuario findOneByApellidos(string $apellidos) Return the first ChildUsuario filtered by the apellidos column
 * @method     ChildUsuario findOneByFkperfil(int $fkperfil) Return the first ChildUsuario filtered by the fkperfil column
 * @method     ChildUsuario findOneByDescendantClass(string $descendant_class) Return the first ChildUsuario filtered by the descendant_class column *

 * @method     ChildUsuario requirePk($key, ConnectionInterface $con = null) Return the ChildUsuario by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOne(ConnectionInterface $con = null) Return the first ChildUsuario matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuario requireOneByIdusuario(string $idusuario) Return the first ChildUsuario filtered by the idusuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByPassword(string $password) Return the first ChildUsuario filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByEmail(string $email) Return the first ChildUsuario filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByAvatar(string $avatar) Return the first ChildUsuario filtered by the avatar column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByNombre(string $nombre) Return the first ChildUsuario filtered by the nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByApellidos(string $apellidos) Return the first ChildUsuario filtered by the apellidos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByFkperfil(int $fkperfil) Return the first ChildUsuario filtered by the fkperfil column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByDescendantClass(string $descendant_class) Return the first ChildUsuario filtered by the descendant_class column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuario[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsuario objects based on current ModelCriteria
 * @method     ChildUsuario[]|ObjectCollection findByIdusuario(string $idusuario) Return ChildUsuario objects filtered by the idusuario column
 * @method     ChildUsuario[]|ObjectCollection findByPassword(string $password) Return ChildUsuario objects filtered by the password column
 * @method     ChildUsuario[]|ObjectCollection findByEmail(string $email) Return ChildUsuario objects filtered by the email column
 * @method     ChildUsuario[]|ObjectCollection findByAvatar(string $avatar) Return ChildUsuario objects filtered by the avatar column
 * @method     ChildUsuario[]|ObjectCollection findByNombre(string $nombre) Return ChildUsuario objects filtered by the nombre column
 * @method     ChildUsuario[]|ObjectCollection findByApellidos(string $apellidos) Return ChildUsuario objects filtered by the apellidos column
 * @method     ChildUsuario[]|ObjectCollection findByFkperfil(int $fkperfil) Return ChildUsuario objects filtered by the fkperfil column
 * @method     ChildUsuario[]|ObjectCollection findByDescendantClass(string $descendant_class) Return ChildUsuario objects filtered by the descendant_class column
 * @method     ChildUsuario[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsuarioQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsuarioQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'prueba', $modelName = '\\Usuario', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsuarioQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsuarioQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsuarioQuery) {
            return $criteria;
        }
        $query = new ChildUsuarioQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUsuario|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsuarioTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsuarioTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUsuario A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idusuario, password, email, avatar, nombre, apellidos, fkperfil, descendant_class FROM Usuario WHERE idusuario = :p0';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUsuario $obj */
            $obj = new ChildUsuario();
            $obj->hydrate($row);
            UsuarioTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildUsuario|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsuarioTableMap::COL_IDUSUARIO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsuarioTableMap::COL_IDUSUARIO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idusuario column
     *
     * Example usage:
     * <code>
     * $query->filterByIdusuario('fooValue');   // WHERE idusuario = 'fooValue'
     * $query->filterByIdusuario('%fooValue%'); // WHERE idusuario LIKE '%fooValue%'
     * </code>
     *
     * @param     string $idusuario The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByIdusuario($idusuario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idusuario)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_IDUSUARIO, $idusuario, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the avatar column
     *
     * Example usage:
     * <code>
     * $query->filterByAvatar('fooValue');   // WHERE avatar = 'fooValue'
     * $query->filterByAvatar('%fooValue%'); // WHERE avatar LIKE '%fooValue%'
     * </code>
     *
     * @param     string $avatar The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByAvatar($avatar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($avatar)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_AVATAR, $avatar, $comparison);
    }

    /**
     * Filter the query on the nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE nombre = 'fooValue'
     * $query->filterByNombre('%fooValue%'); // WHERE nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the apellidos column
     *
     * Example usage:
     * <code>
     * $query->filterByApellidos('fooValue');   // WHERE apellidos = 'fooValue'
     * $query->filterByApellidos('%fooValue%'); // WHERE apellidos LIKE '%fooValue%'
     * </code>
     *
     * @param     string $apellidos The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByApellidos($apellidos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apellidos)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_APELLIDOS, $apellidos, $comparison);
    }

    /**
     * Filter the query on the fkperfil column
     *
     * Example usage:
     * <code>
     * $query->filterByFkperfil(1234); // WHERE fkperfil = 1234
     * $query->filterByFkperfil(array(12, 34)); // WHERE fkperfil IN (12, 34)
     * $query->filterByFkperfil(array('min' => 12)); // WHERE fkperfil > 12
     * </code>
     *
     * @see       filterByPerfil()
     *
     * @param     mixed $fkperfil The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByFkperfil($fkperfil = null, $comparison = null)
    {
        if (is_array($fkperfil)) {
            $useMinMax = false;
            if (isset($fkperfil['min'])) {
                $this->addUsingAlias(UsuarioTableMap::COL_FKPERFIL, $fkperfil['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkperfil['max'])) {
                $this->addUsingAlias(UsuarioTableMap::COL_FKPERFIL, $fkperfil['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_FKPERFIL, $fkperfil, $comparison);
    }

    /**
     * Filter the query on the descendant_class column
     *
     * Example usage:
     * <code>
     * $query->filterByDescendantClass('fooValue');   // WHERE descendant_class = 'fooValue'
     * $query->filterByDescendantClass('%fooValue%'); // WHERE descendant_class LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descendantClass The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByDescendantClass($descendantClass = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descendantClass)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_DESCENDANT_CLASS, $descendantClass, $comparison);
    }

    /**
     * Filter the query by a related \Perfil object
     *
     * @param \Perfil|ObjectCollection $perfil The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPerfil($perfil, $comparison = null)
    {
        if ($perfil instanceof \Perfil) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_FKPERFIL, $perfil->getIdperfil(), $comparison);
        } elseif ($perfil instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsuarioTableMap::COL_FKPERFIL, $perfil->toKeyValue('PrimaryKey', 'Idperfil'), $comparison);
        } else {
            throw new PropelException('filterByPerfil() only accepts arguments of type \Perfil or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Perfil relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinPerfil($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Perfil');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Perfil');
        }

        return $this;
    }

    /**
     * Use the Perfil relation Perfil object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PerfilQuery A secondary query class using the current class as primary query
     */
    public function usePerfilQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPerfil($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Perfil', '\PerfilQuery');
    }

    /**
     * Filter the query by a related \Amigos object
     *
     * @param \Amigos|ObjectCollection $amigos the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByAmigosRelatedByIdusuario($amigos, $comparison = null)
    {
        if ($amigos instanceof \Amigos) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_IDUSUARIO, $amigos->getIdusuario(), $comparison);
        } elseif ($amigos instanceof ObjectCollection) {
            return $this
                ->useAmigosRelatedByIdusuarioQuery()
                ->filterByPrimaryKeys($amigos->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAmigosRelatedByIdusuario() only accepts arguments of type \Amigos or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AmigosRelatedByIdusuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinAmigosRelatedByIdusuario($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AmigosRelatedByIdusuario');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'AmigosRelatedByIdusuario');
        }

        return $this;
    }

    /**
     * Use the AmigosRelatedByIdusuario relation Amigos object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AmigosQuery A secondary query class using the current class as primary query
     */
    public function useAmigosRelatedByIdusuarioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAmigosRelatedByIdusuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AmigosRelatedByIdusuario', '\AmigosQuery');
    }

    /**
     * Filter the query by a related \Amigos object
     *
     * @param \Amigos|ObjectCollection $amigos the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByAmigosRelatedByRelacionusuario($amigos, $comparison = null)
    {
        if ($amigos instanceof \Amigos) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_IDUSUARIO, $amigos->getRelacionusuario(), $comparison);
        } elseif ($amigos instanceof ObjectCollection) {
            return $this
                ->useAmigosRelatedByRelacionusuarioQuery()
                ->filterByPrimaryKeys($amigos->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAmigosRelatedByRelacionusuario() only accepts arguments of type \Amigos or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AmigosRelatedByRelacionusuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinAmigosRelatedByRelacionusuario($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AmigosRelatedByRelacionusuario');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'AmigosRelatedByRelacionusuario');
        }

        return $this;
    }

    /**
     * Use the AmigosRelatedByRelacionusuario relation Amigos object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AmigosQuery A secondary query class using the current class as primary query
     */
    public function useAmigosRelatedByRelacionusuarioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAmigosRelatedByRelacionusuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AmigosRelatedByRelacionusuario', '\AmigosQuery');
    }

    /**
     * Filter the query by a related \Viajes object
     *
     * @param \Viajes|ObjectCollection $viajes the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByViajes($viajes, $comparison = null)
    {
        if ($viajes instanceof \Viajes) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_IDUSUARIO, $viajes->getIdusuario(), $comparison);
        } elseif ($viajes instanceof ObjectCollection) {
            return $this
                ->useViajesQuery()
                ->filterByPrimaryKeys($viajes->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByViajes() only accepts arguments of type \Viajes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Viajes relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinViajes($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Viajes');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Viajes');
        }

        return $this;
    }

    /**
     * Use the Viajes relation Viajes object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ViajesQuery A secondary query class using the current class as primary query
     */
    public function useViajesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinViajes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Viajes', '\ViajesQuery');
    }

    /**
     * Filter the query by a related \UsuarioGrupos object
     *
     * @param \UsuarioGrupos|ObjectCollection $usuarioGrupos the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByUsuarioGrupos($usuarioGrupos, $comparison = null)
    {
        if ($usuarioGrupos instanceof \UsuarioGrupos) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_IDUSUARIO, $usuarioGrupos->getIdusuario(), $comparison);
        } elseif ($usuarioGrupos instanceof ObjectCollection) {
            return $this
                ->useUsuarioGruposQuery()
                ->filterByPrimaryKeys($usuarioGrupos->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsuarioGrupos() only accepts arguments of type \UsuarioGrupos or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsuarioGrupos relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinUsuarioGrupos($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsuarioGrupos');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'UsuarioGrupos');
        }

        return $this;
    }

    /**
     * Use the UsuarioGrupos relation UsuarioGrupos object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsuarioGruposQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioGruposQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuarioGrupos($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsuarioGrupos', '\UsuarioGruposQuery');
    }

    /**
     * Filter the query by a related \Invitacion object
     *
     * @param \Invitacion|ObjectCollection $invitacion the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByInvitacion($invitacion, $comparison = null)
    {
        if ($invitacion instanceof \Invitacion) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_IDUSUARIO, $invitacion->getFkusuario(), $comparison);
        } elseif ($invitacion instanceof ObjectCollection) {
            return $this
                ->useInvitacionQuery()
                ->filterByPrimaryKeys($invitacion->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByInvitacion() only accepts arguments of type \Invitacion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Invitacion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinInvitacion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Invitacion');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Invitacion');
        }

        return $this;
    }

    /**
     * Use the Invitacion relation Invitacion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \InvitacionQuery A secondary query class using the current class as primary query
     */
    public function useInvitacionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinInvitacion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Invitacion', '\InvitacionQuery');
    }

    /**
     * Filter the query by a related \Administrador object
     *
     * @param \Administrador|ObjectCollection $administrador the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByAdministrador($administrador, $comparison = null)
    {
        if ($administrador instanceof \Administrador) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_IDUSUARIO, $administrador->getIdusuario(), $comparison);
        } elseif ($administrador instanceof ObjectCollection) {
            return $this
                ->useAdministradorQuery()
                ->filterByPrimaryKeys($administrador->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAdministrador() only accepts arguments of type \Administrador or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Administrador relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinAdministrador($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Administrador');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Administrador');
        }

        return $this;
    }

    /**
     * Use the Administrador relation Administrador object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AdministradorQuery A secondary query class using the current class as primary query
     */
    public function useAdministradorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAdministrador($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Administrador', '\AdministradorQuery');
    }

    /**
     * Filter the query by a related \Colaborador object
     *
     * @param \Colaborador|ObjectCollection $colaborador the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByColaborador($colaborador, $comparison = null)
    {
        if ($colaborador instanceof \Colaborador) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_IDUSUARIO, $colaborador->getIdusuario(), $comparison);
        } elseif ($colaborador instanceof ObjectCollection) {
            return $this
                ->useColaboradorQuery()
                ->filterByPrimaryKeys($colaborador->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByColaborador() only accepts arguments of type \Colaborador or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Colaborador relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinColaborador($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Colaborador');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Colaborador');
        }

        return $this;
    }

    /**
     * Use the Colaborador relation Colaborador object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ColaboradorQuery A secondary query class using the current class as primary query
     */
    public function useColaboradorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinColaborador($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Colaborador', '\ColaboradorQuery');
    }

    /**
     * Filter the query by a related Usuario object
     * using the amigos table as cross reference
     *
     * @param Usuario $usuario the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByUsuarioRelatedByRelacionusuario($usuario, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useAmigosRelatedByIdusuarioQuery()
            ->filterByUsuarioRelatedByRelacionusuario($usuario, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Usuario object
     * using the amigos table as cross reference
     *
     * @param Usuario $usuario the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByUsuarioRelatedByIdusuario($usuario, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useAmigosRelatedByRelacionusuarioQuery()
            ->filterByUsuarioRelatedByIdusuario($usuario, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Viaje object
     * using the viajes table as cross reference
     *
     * @param Viaje $viaje the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByViaje($viaje, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useViajesQuery()
            ->filterByViaje($viaje, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Grupo object
     * using the Usuario_grupos table as cross reference
     *
     * @param Grupo $grupo the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByGrupo($grupo, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useUsuarioGruposQuery()
            ->filterByGrupo($grupo, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsuario $usuario Object to remove from the list of results
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function prune($usuario = null)
    {
        if ($usuario) {
            $this->addUsingAlias(UsuarioTableMap::COL_IDUSUARIO, $usuario->getIdusuario(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Usuario table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsuarioTableMap::clearInstancePool();
            UsuarioTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsuarioTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            UsuarioTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            UsuarioTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsuarioQuery
