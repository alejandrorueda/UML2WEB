<?php

namespace Base;

use \Colaborador as ChildColaborador;
use \ColaboradorQuery as ChildColaboradorQuery;
use \UsuarioQuery as ChildUsuarioQuery;
use \Exception;
use \PDO;
use Map\ColaboradorTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Colaborador' table.
 *
 * 
 *
 * @method     ChildColaboradorQuery orderByPrueba($order = Criteria::ASC) Order by the prueba column
 * @method     ChildColaboradorQuery orderByMensaje($order = Criteria::ASC) Order by the mensaje column
 * @method     ChildColaboradorQuery orderByIdcolaborador2($order = Criteria::ASC) Order by the idColaborador2 column
 * @method     ChildColaboradorQuery orderByIdusuario($order = Criteria::ASC) Order by the idusuario column
 * @method     ChildColaboradorQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildColaboradorQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildColaboradorQuery orderByAvatar($order = Criteria::ASC) Order by the avatar column
 * @method     ChildColaboradorQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 * @method     ChildColaboradorQuery orderByApellidos($order = Criteria::ASC) Order by the apellidos column
 * @method     ChildColaboradorQuery orderByFkperfil($order = Criteria::ASC) Order by the fkperfil column
 *
 * @method     ChildColaboradorQuery groupByPrueba() Group by the prueba column
 * @method     ChildColaboradorQuery groupByMensaje() Group by the mensaje column
 * @method     ChildColaboradorQuery groupByIdcolaborador2() Group by the idColaborador2 column
 * @method     ChildColaboradorQuery groupByIdusuario() Group by the idusuario column
 * @method     ChildColaboradorQuery groupByPassword() Group by the password column
 * @method     ChildColaboradorQuery groupByEmail() Group by the email column
 * @method     ChildColaboradorQuery groupByAvatar() Group by the avatar column
 * @method     ChildColaboradorQuery groupByNombre() Group by the nombre column
 * @method     ChildColaboradorQuery groupByApellidos() Group by the apellidos column
 * @method     ChildColaboradorQuery groupByFkperfil() Group by the fkperfil column
 *
 * @method     ChildColaboradorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildColaboradorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildColaboradorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildColaboradorQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildColaboradorQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildColaboradorQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildColaboradorQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildColaboradorQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildColaboradorQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildColaboradorQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildColaboradorQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildColaboradorQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildColaboradorQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     ChildColaboradorQuery leftJoinPerfil($relationAlias = null) Adds a LEFT JOIN clause to the query using the Perfil relation
 * @method     ChildColaboradorQuery rightJoinPerfil($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Perfil relation
 * @method     ChildColaboradorQuery innerJoinPerfil($relationAlias = null) Adds a INNER JOIN clause to the query using the Perfil relation
 *
 * @method     ChildColaboradorQuery joinWithPerfil($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Perfil relation
 *
 * @method     ChildColaboradorQuery leftJoinWithPerfil() Adds a LEFT JOIN clause and with to the query using the Perfil relation
 * @method     ChildColaboradorQuery rightJoinWithPerfil() Adds a RIGHT JOIN clause and with to the query using the Perfil relation
 * @method     ChildColaboradorQuery innerJoinWithPerfil() Adds a INNER JOIN clause and with to the query using the Perfil relation
 *
 * @method     \UsuarioQuery|\PerfilQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildColaborador findOne(ConnectionInterface $con = null) Return the first ChildColaborador matching the query
 * @method     ChildColaborador findOneOrCreate(ConnectionInterface $con = null) Return the first ChildColaborador matching the query, or a new ChildColaborador object populated from the query conditions when no match is found
 *
 * @method     ChildColaborador findOneByPrueba(string $prueba) Return the first ChildColaborador filtered by the prueba column
 * @method     ChildColaborador findOneByMensaje(int $mensaje) Return the first ChildColaborador filtered by the mensaje column
 * @method     ChildColaborador findOneByIdcolaborador2(string $idColaborador2) Return the first ChildColaborador filtered by the idColaborador2 column
 * @method     ChildColaborador findOneByIdusuario(string $idusuario) Return the first ChildColaborador filtered by the idusuario column
 * @method     ChildColaborador findOneByPassword(string $password) Return the first ChildColaborador filtered by the password column
 * @method     ChildColaborador findOneByEmail(string $email) Return the first ChildColaborador filtered by the email column
 * @method     ChildColaborador findOneByAvatar(string $avatar) Return the first ChildColaborador filtered by the avatar column
 * @method     ChildColaborador findOneByNombre(string $nombre) Return the first ChildColaborador filtered by the nombre column
 * @method     ChildColaborador findOneByApellidos(string $apellidos) Return the first ChildColaborador filtered by the apellidos column
 * @method     ChildColaborador findOneByFkperfil(int $fkperfil) Return the first ChildColaborador filtered by the fkperfil column *

 * @method     ChildColaborador requirePk($key, ConnectionInterface $con = null) Return the ChildColaborador by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildColaborador requireOne(ConnectionInterface $con = null) Return the first ChildColaborador matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildColaborador requireOneByPrueba(string $prueba) Return the first ChildColaborador filtered by the prueba column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildColaborador requireOneByMensaje(int $mensaje) Return the first ChildColaborador filtered by the mensaje column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildColaborador requireOneByIdcolaborador2(string $idColaborador2) Return the first ChildColaborador filtered by the idColaborador2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildColaborador requireOneByIdusuario(string $idusuario) Return the first ChildColaborador filtered by the idusuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildColaborador requireOneByPassword(string $password) Return the first ChildColaborador filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildColaborador requireOneByEmail(string $email) Return the first ChildColaborador filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildColaborador requireOneByAvatar(string $avatar) Return the first ChildColaborador filtered by the avatar column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildColaborador requireOneByNombre(string $nombre) Return the first ChildColaborador filtered by the nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildColaborador requireOneByApellidos(string $apellidos) Return the first ChildColaborador filtered by the apellidos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildColaborador requireOneByFkperfil(int $fkperfil) Return the first ChildColaborador filtered by the fkperfil column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildColaborador[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildColaborador objects based on current ModelCriteria
 * @method     ChildColaborador[]|ObjectCollection findByPrueba(string $prueba) Return ChildColaborador objects filtered by the prueba column
 * @method     ChildColaborador[]|ObjectCollection findByMensaje(int $mensaje) Return ChildColaborador objects filtered by the mensaje column
 * @method     ChildColaborador[]|ObjectCollection findByIdcolaborador2(string $idColaborador2) Return ChildColaborador objects filtered by the idColaborador2 column
 * @method     ChildColaborador[]|ObjectCollection findByIdusuario(string $idusuario) Return ChildColaborador objects filtered by the idusuario column
 * @method     ChildColaborador[]|ObjectCollection findByPassword(string $password) Return ChildColaborador objects filtered by the password column
 * @method     ChildColaborador[]|ObjectCollection findByEmail(string $email) Return ChildColaborador objects filtered by the email column
 * @method     ChildColaborador[]|ObjectCollection findByAvatar(string $avatar) Return ChildColaborador objects filtered by the avatar column
 * @method     ChildColaborador[]|ObjectCollection findByNombre(string $nombre) Return ChildColaborador objects filtered by the nombre column
 * @method     ChildColaborador[]|ObjectCollection findByApellidos(string $apellidos) Return ChildColaborador objects filtered by the apellidos column
 * @method     ChildColaborador[]|ObjectCollection findByFkperfil(int $fkperfil) Return ChildColaborador objects filtered by the fkperfil column
 * @method     ChildColaborador[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ColaboradorQuery extends ChildUsuarioQuery
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ColaboradorQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'prueba', $modelName = '\\Colaborador', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildColaboradorQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildColaboradorQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildColaboradorQuery) {
            return $criteria;
        }
        $query = new ChildColaboradorQuery();
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
     * @param array[$idColaborador2, $idusuario] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildColaborador|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ColaboradorTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ColaboradorTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildColaborador A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT prueba, mensaje, idColaborador2, idusuario, password, email, avatar, nombre, apellidos, fkperfil FROM Colaborador WHERE idColaborador2 = :p0 AND idusuario = :p1';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);            
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildColaborador $obj */
            $obj = new ChildColaborador();
            $obj->hydrate($row);
            ColaboradorTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildColaborador|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ColaboradorTableMap::COL_IDCOLABORADOR2, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ColaboradorTableMap::COL_IDUSUARIO, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ColaboradorTableMap::COL_IDCOLABORADOR2, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ColaboradorTableMap::COL_IDUSUARIO, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the prueba column
     *
     * Example usage:
     * <code>
     * $query->filterByPrueba(1234); // WHERE prueba = 1234
     * $query->filterByPrueba(array(12, 34)); // WHERE prueba IN (12, 34)
     * $query->filterByPrueba(array('min' => 12)); // WHERE prueba > 12
     * </code>
     *
     * @param     mixed $prueba The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByPrueba($prueba = null, $comparison = null)
    {
        if (is_array($prueba)) {
            $useMinMax = false;
            if (isset($prueba['min'])) {
                $this->addUsingAlias(ColaboradorTableMap::COL_PRUEBA, $prueba['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prueba['max'])) {
                $this->addUsingAlias(ColaboradorTableMap::COL_PRUEBA, $prueba['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColaboradorTableMap::COL_PRUEBA, $prueba, $comparison);
    }

    /**
     * Filter the query on the mensaje column
     *
     * Example usage:
     * <code>
     * $query->filterByMensaje(1234); // WHERE mensaje = 1234
     * $query->filterByMensaje(array(12, 34)); // WHERE mensaje IN (12, 34)
     * $query->filterByMensaje(array('min' => 12)); // WHERE mensaje > 12
     * </code>
     *
     * @param     mixed $mensaje The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByMensaje($mensaje = null, $comparison = null)
    {
        if (is_array($mensaje)) {
            $useMinMax = false;
            if (isset($mensaje['min'])) {
                $this->addUsingAlias(ColaboradorTableMap::COL_MENSAJE, $mensaje['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mensaje['max'])) {
                $this->addUsingAlias(ColaboradorTableMap::COL_MENSAJE, $mensaje['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColaboradorTableMap::COL_MENSAJE, $mensaje, $comparison);
    }

    /**
     * Filter the query on the idColaborador2 column
     *
     * Example usage:
     * <code>
     * $query->filterByIdcolaborador2('fooValue');   // WHERE idColaborador2 = 'fooValue'
     * $query->filterByIdcolaborador2('%fooValue%'); // WHERE idColaborador2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $idcolaborador2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByIdcolaborador2($idcolaborador2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idcolaborador2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColaboradorTableMap::COL_IDCOLABORADOR2, $idcolaborador2, $comparison);
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
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByIdusuario($idusuario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idusuario)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColaboradorTableMap::COL_IDUSUARIO, $idusuario, $comparison);
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
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColaboradorTableMap::COL_PASSWORD, $password, $comparison);
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
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColaboradorTableMap::COL_EMAIL, $email, $comparison);
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
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByAvatar($avatar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($avatar)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColaboradorTableMap::COL_AVATAR, $avatar, $comparison);
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
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColaboradorTableMap::COL_NOMBRE, $nombre, $comparison);
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
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByApellidos($apellidos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apellidos)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColaboradorTableMap::COL_APELLIDOS, $apellidos, $comparison);
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
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByFkperfil($fkperfil = null, $comparison = null)
    {
        if (is_array($fkperfil)) {
            $useMinMax = false;
            if (isset($fkperfil['min'])) {
                $this->addUsingAlias(ColaboradorTableMap::COL_FKPERFIL, $fkperfil['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkperfil['max'])) {
                $this->addUsingAlias(ColaboradorTableMap::COL_FKPERFIL, $fkperfil['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColaboradorTableMap::COL_FKPERFIL, $fkperfil, $comparison);
    }

    /**
     * Filter the query by a related \Usuario object
     *
     * @param \Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Usuario) {
            return $this
                ->addUsingAlias(ColaboradorTableMap::COL_IDUSUARIO, $usuario->getIdusuario(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ColaboradorTableMap::COL_IDUSUARIO, $usuario->toKeyValue('PrimaryKey', 'Idusuario'), $comparison);
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
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
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
     * @return ChildColaboradorQuery The current query, for fluid interface
     */
    public function filterByPerfil($perfil, $comparison = null)
    {
        if ($perfil instanceof \Perfil) {
            return $this
                ->addUsingAlias(ColaboradorTableMap::COL_FKPERFIL, $perfil->getIdperfil(), $comparison);
        } elseif ($perfil instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ColaboradorTableMap::COL_FKPERFIL, $perfil->toKeyValue('PrimaryKey', 'Idperfil'), $comparison);
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
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
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
     * @param   ChildColaborador $colaborador Object to remove from the list of results
     *
     * @return $this|ChildColaboradorQuery The current query, for fluid interface
     */
    public function prune($colaborador = null)
    {
        if ($colaborador) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ColaboradorTableMap::COL_IDCOLABORADOR2), $colaborador->getIdcolaborador2(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ColaboradorTableMap::COL_IDUSUARIO), $colaborador->getIdusuario(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Colaborador table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ColaboradorTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ColaboradorTableMap::clearInstancePool();
            ColaboradorTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ColaboradorTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ColaboradorTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ColaboradorTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ColaboradorTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ColaboradorQuery
