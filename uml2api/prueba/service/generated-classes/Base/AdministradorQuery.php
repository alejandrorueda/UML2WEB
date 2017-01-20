<?php

namespace Base;

use \Administrador as ChildAdministrador;
use \AdministradorQuery as ChildAdministradorQuery;
use \UsuarioQuery as ChildUsuarioQuery;
use \Exception;
use \PDO;
use Map\AdministradorTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Administrador' table.
 *
 * 
 *
 * @method     ChildAdministradorQuery orderByIdadministrador($order = Criteria::ASC) Order by the idAdministrador column
 * @method     ChildAdministradorQuery orderByIdusuario($order = Criteria::ASC) Order by the idusuario column
 * @method     ChildAdministradorQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildAdministradorQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildAdministradorQuery orderByAvatar($order = Criteria::ASC) Order by the avatar column
 * @method     ChildAdministradorQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 * @method     ChildAdministradorQuery orderByApellidos($order = Criteria::ASC) Order by the apellidos column
 * @method     ChildAdministradorQuery orderByFkperfil($order = Criteria::ASC) Order by the fkperfil column
 *
 * @method     ChildAdministradorQuery groupByIdadministrador() Group by the idAdministrador column
 * @method     ChildAdministradorQuery groupByIdusuario() Group by the idusuario column
 * @method     ChildAdministradorQuery groupByPassword() Group by the password column
 * @method     ChildAdministradorQuery groupByEmail() Group by the email column
 * @method     ChildAdministradorQuery groupByAvatar() Group by the avatar column
 * @method     ChildAdministradorQuery groupByNombre() Group by the nombre column
 * @method     ChildAdministradorQuery groupByApellidos() Group by the apellidos column
 * @method     ChildAdministradorQuery groupByFkperfil() Group by the fkperfil column
 *
 * @method     ChildAdministradorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAdministradorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAdministradorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAdministradorQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAdministradorQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAdministradorQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAdministradorQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildAdministradorQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildAdministradorQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildAdministradorQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildAdministradorQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildAdministradorQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildAdministradorQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     ChildAdministradorQuery leftJoinPerfil($relationAlias = null) Adds a LEFT JOIN clause to the query using the Perfil relation
 * @method     ChildAdministradorQuery rightJoinPerfil($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Perfil relation
 * @method     ChildAdministradorQuery innerJoinPerfil($relationAlias = null) Adds a INNER JOIN clause to the query using the Perfil relation
 *
 * @method     ChildAdministradorQuery joinWithPerfil($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Perfil relation
 *
 * @method     ChildAdministradorQuery leftJoinWithPerfil() Adds a LEFT JOIN clause and with to the query using the Perfil relation
 * @method     ChildAdministradorQuery rightJoinWithPerfil() Adds a RIGHT JOIN clause and with to the query using the Perfil relation
 * @method     ChildAdministradorQuery innerJoinWithPerfil() Adds a INNER JOIN clause and with to the query using the Perfil relation
 *
 * @method     \UsuarioQuery|\PerfilQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAdministrador findOne(ConnectionInterface $con = null) Return the first ChildAdministrador matching the query
 * @method     ChildAdministrador findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAdministrador matching the query, or a new ChildAdministrador object populated from the query conditions when no match is found
 *
 * @method     ChildAdministrador findOneByIdadministrador(int $idAdministrador) Return the first ChildAdministrador filtered by the idAdministrador column
 * @method     ChildAdministrador findOneByIdusuario(string $idusuario) Return the first ChildAdministrador filtered by the idusuario column
 * @method     ChildAdministrador findOneByPassword(string $password) Return the first ChildAdministrador filtered by the password column
 * @method     ChildAdministrador findOneByEmail(string $email) Return the first ChildAdministrador filtered by the email column
 * @method     ChildAdministrador findOneByAvatar(string $avatar) Return the first ChildAdministrador filtered by the avatar column
 * @method     ChildAdministrador findOneByNombre(string $nombre) Return the first ChildAdministrador filtered by the nombre column
 * @method     ChildAdministrador findOneByApellidos(string $apellidos) Return the first ChildAdministrador filtered by the apellidos column
 * @method     ChildAdministrador findOneByFkperfil(int $fkperfil) Return the first ChildAdministrador filtered by the fkperfil column *

 * @method     ChildAdministrador requirePk($key, ConnectionInterface $con = null) Return the ChildAdministrador by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdministrador requireOne(ConnectionInterface $con = null) Return the first ChildAdministrador matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAdministrador requireOneByIdadministrador(int $idAdministrador) Return the first ChildAdministrador filtered by the idAdministrador column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdministrador requireOneByIdusuario(string $idusuario) Return the first ChildAdministrador filtered by the idusuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdministrador requireOneByPassword(string $password) Return the first ChildAdministrador filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdministrador requireOneByEmail(string $email) Return the first ChildAdministrador filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdministrador requireOneByAvatar(string $avatar) Return the first ChildAdministrador filtered by the avatar column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdministrador requireOneByNombre(string $nombre) Return the first ChildAdministrador filtered by the nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdministrador requireOneByApellidos(string $apellidos) Return the first ChildAdministrador filtered by the apellidos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdministrador requireOneByFkperfil(int $fkperfil) Return the first ChildAdministrador filtered by the fkperfil column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAdministrador[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAdministrador objects based on current ModelCriteria
 * @method     ChildAdministrador[]|ObjectCollection findByIdadministrador(int $idAdministrador) Return ChildAdministrador objects filtered by the idAdministrador column
 * @method     ChildAdministrador[]|ObjectCollection findByIdusuario(string $idusuario) Return ChildAdministrador objects filtered by the idusuario column
 * @method     ChildAdministrador[]|ObjectCollection findByPassword(string $password) Return ChildAdministrador objects filtered by the password column
 * @method     ChildAdministrador[]|ObjectCollection findByEmail(string $email) Return ChildAdministrador objects filtered by the email column
 * @method     ChildAdministrador[]|ObjectCollection findByAvatar(string $avatar) Return ChildAdministrador objects filtered by the avatar column
 * @method     ChildAdministrador[]|ObjectCollection findByNombre(string $nombre) Return ChildAdministrador objects filtered by the nombre column
 * @method     ChildAdministrador[]|ObjectCollection findByApellidos(string $apellidos) Return ChildAdministrador objects filtered by the apellidos column
 * @method     ChildAdministrador[]|ObjectCollection findByFkperfil(int $fkperfil) Return ChildAdministrador objects filtered by the fkperfil column
 * @method     ChildAdministrador[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AdministradorQuery extends ChildUsuarioQuery
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\AdministradorQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'prueba', $modelName = '\\Administrador', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAdministradorQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAdministradorQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAdministradorQuery) {
            return $criteria;
        }
        $query = new ChildAdministradorQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$idAdministrador, $idusuario] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildAdministrador|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AdministradorTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AdministradorTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildAdministrador A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idAdministrador, idusuario, password, email, avatar, nombre, apellidos, fkperfil FROM Administrador WHERE idAdministrador = :p0 AND idusuario = :p1';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);            
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildAdministrador $obj */
            $obj = new ChildAdministrador();
            $obj->hydrate($row);
            AdministradorTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildAdministrador|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildAdministradorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(AdministradorTableMap::COL_IDADMINISTRADOR, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(AdministradorTableMap::COL_IDUSUARIO, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAdministradorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(AdministradorTableMap::COL_IDADMINISTRADOR, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(AdministradorTableMap::COL_IDUSUARIO, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the idAdministrador column
     *
     * Example usage:
     * <code>
     * $query->filterByIdadministrador(1234); // WHERE idAdministrador = 1234
     * $query->filterByIdadministrador(array(12, 34)); // WHERE idAdministrador IN (12, 34)
     * $query->filterByIdadministrador(array('min' => 12)); // WHERE idAdministrador > 12
     * </code>
     *
     * @param     mixed $idadministrador The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAdministradorQuery The current query, for fluid interface
     */
    public function filterByIdadministrador($idadministrador = null, $comparison = null)
    {
        if (is_array($idadministrador)) {
            $useMinMax = false;
            if (isset($idadministrador['min'])) {
                $this->addUsingAlias(AdministradorTableMap::COL_IDADMINISTRADOR, $idadministrador['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idadministrador['max'])) {
                $this->addUsingAlias(AdministradorTableMap::COL_IDADMINISTRADOR, $idadministrador['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdministradorTableMap::COL_IDADMINISTRADOR, $idadministrador, $comparison);
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
     * @return $this|ChildAdministradorQuery The current query, for fluid interface
     */
    public function filterByIdusuario($idusuario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idusuario)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdministradorTableMap::COL_IDUSUARIO, $idusuario, $comparison);
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
     * @return $this|ChildAdministradorQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdministradorTableMap::COL_PASSWORD, $password, $comparison);
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
     * @return $this|ChildAdministradorQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdministradorTableMap::COL_EMAIL, $email, $comparison);
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
     * @return $this|ChildAdministradorQuery The current query, for fluid interface
     */
    public function filterByAvatar($avatar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($avatar)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdministradorTableMap::COL_AVATAR, $avatar, $comparison);
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
     * @return $this|ChildAdministradorQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdministradorTableMap::COL_NOMBRE, $nombre, $comparison);
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
     * @return $this|ChildAdministradorQuery The current query, for fluid interface
     */
    public function filterByApellidos($apellidos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apellidos)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdministradorTableMap::COL_APELLIDOS, $apellidos, $comparison);
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
     * @return $this|ChildAdministradorQuery The current query, for fluid interface
     */
    public function filterByFkperfil($fkperfil = null, $comparison = null)
    {
        if (is_array($fkperfil)) {
            $useMinMax = false;
            if (isset($fkperfil['min'])) {
                $this->addUsingAlias(AdministradorTableMap::COL_FKPERFIL, $fkperfil['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkperfil['max'])) {
                $this->addUsingAlias(AdministradorTableMap::COL_FKPERFIL, $fkperfil['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdministradorTableMap::COL_FKPERFIL, $fkperfil, $comparison);
    }

    /**
     * Filter the query by a related \Usuario object
     *
     * @param \Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAdministradorQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Usuario) {
            return $this
                ->addUsingAlias(AdministradorTableMap::COL_IDUSUARIO, $usuario->getIdusuario(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AdministradorTableMap::COL_IDUSUARIO, $usuario->toKeyValue('PrimaryKey', 'Idusuario'), $comparison);
        } else {
            throw new PropelException('filterByUsuario() only accepts arguments of type \Usuario or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Usuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAdministradorQuery The current query, for fluid interface
     */
    public function joinUsuario($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Usuario');

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
            $this->addJoinObject($join, 'Usuario');
        }

        return $this;
    }

    /**
     * Use the Usuario relation Usuario object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsuarioQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Usuario', '\UsuarioQuery');
    }

    /**
     * Filter the query by a related \Perfil object
     *
     * @param \Perfil|ObjectCollection $perfil The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAdministradorQuery The current query, for fluid interface
     */
    public function filterByPerfil($perfil, $comparison = null)
    {
        if ($perfil instanceof \Perfil) {
            return $this
                ->addUsingAlias(AdministradorTableMap::COL_FKPERFIL, $perfil->getIdperfil(), $comparison);
        } elseif ($perfil instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AdministradorTableMap::COL_FKPERFIL, $perfil->toKeyValue('PrimaryKey', 'Idperfil'), $comparison);
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
     * @return $this|ChildAdministradorQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildAdministrador $administrador Object to remove from the list of results
     *
     * @return $this|ChildAdministradorQuery The current query, for fluid interface
     */
    public function prune($administrador = null)
    {
        if ($administrador) {
            $this->addCond('pruneCond0', $this->getAliasedColName(AdministradorTableMap::COL_IDADMINISTRADOR), $administrador->getIdadministrador(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(AdministradorTableMap::COL_IDUSUARIO), $administrador->getIdusuario(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Administrador table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdministradorTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AdministradorTableMap::clearInstancePool();
            AdministradorTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AdministradorTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AdministradorTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            AdministradorTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            AdministradorTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AdministradorQuery
