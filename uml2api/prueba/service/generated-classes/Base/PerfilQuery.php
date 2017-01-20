<?php

namespace Base;

use \Perfil as ChildPerfil;
use \PerfilQuery as ChildPerfilQuery;
use \Exception;
use \PDO;
use Map\PerfilTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Perfil' table.
 *
 * 
 *
 * @method     ChildPerfilQuery orderByIdperfil($order = Criteria::ASC) Order by the idPerfil column
 * @method     ChildPerfilQuery orderByInformacion($order = Criteria::ASC) Order by the informacion column
 * @method     ChildPerfilQuery orderByNacimiento($order = Criteria::ASC) Order by the nacimiento column
 * @method     ChildPerfilQuery orderByGustos($order = Criteria::ASC) Order by the gustos column
 *
 * @method     ChildPerfilQuery groupByIdperfil() Group by the idPerfil column
 * @method     ChildPerfilQuery groupByInformacion() Group by the informacion column
 * @method     ChildPerfilQuery groupByNacimiento() Group by the nacimiento column
 * @method     ChildPerfilQuery groupByGustos() Group by the gustos column
 *
 * @method     ChildPerfilQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPerfilQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPerfilQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPerfilQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPerfilQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPerfilQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPerfilQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildPerfilQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildPerfilQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildPerfilQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildPerfilQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildPerfilQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildPerfilQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     ChildPerfilQuery leftJoinAdministrador($relationAlias = null) Adds a LEFT JOIN clause to the query using the Administrador relation
 * @method     ChildPerfilQuery rightJoinAdministrador($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Administrador relation
 * @method     ChildPerfilQuery innerJoinAdministrador($relationAlias = null) Adds a INNER JOIN clause to the query using the Administrador relation
 *
 * @method     ChildPerfilQuery joinWithAdministrador($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Administrador relation
 *
 * @method     ChildPerfilQuery leftJoinWithAdministrador() Adds a LEFT JOIN clause and with to the query using the Administrador relation
 * @method     ChildPerfilQuery rightJoinWithAdministrador() Adds a RIGHT JOIN clause and with to the query using the Administrador relation
 * @method     ChildPerfilQuery innerJoinWithAdministrador() Adds a INNER JOIN clause and with to the query using the Administrador relation
 *
 * @method     ChildPerfilQuery leftJoinColaborador($relationAlias = null) Adds a LEFT JOIN clause to the query using the Colaborador relation
 * @method     ChildPerfilQuery rightJoinColaborador($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Colaborador relation
 * @method     ChildPerfilQuery innerJoinColaborador($relationAlias = null) Adds a INNER JOIN clause to the query using the Colaborador relation
 *
 * @method     ChildPerfilQuery joinWithColaborador($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Colaborador relation
 *
 * @method     ChildPerfilQuery leftJoinWithColaborador() Adds a LEFT JOIN clause and with to the query using the Colaborador relation
 * @method     ChildPerfilQuery rightJoinWithColaborador() Adds a RIGHT JOIN clause and with to the query using the Colaborador relation
 * @method     ChildPerfilQuery innerJoinWithColaborador() Adds a INNER JOIN clause and with to the query using the Colaborador relation
 *
 * @method     \UsuarioQuery|\AdministradorQuery|\ColaboradorQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPerfil findOne(ConnectionInterface $con = null) Return the first ChildPerfil matching the query
 * @method     ChildPerfil findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPerfil matching the query, or a new ChildPerfil object populated from the query conditions when no match is found
 *
 * @method     ChildPerfil findOneByIdperfil(int $idPerfil) Return the first ChildPerfil filtered by the idPerfil column
 * @method     ChildPerfil findOneByInformacion(string $informacion) Return the first ChildPerfil filtered by the informacion column
 * @method     ChildPerfil findOneByNacimiento(string $nacimiento) Return the first ChildPerfil filtered by the nacimiento column
 * @method     ChildPerfil findOneByGustos(string $gustos) Return the first ChildPerfil filtered by the gustos column *

 * @method     ChildPerfil requirePk($key, ConnectionInterface $con = null) Return the ChildPerfil by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerfil requireOne(ConnectionInterface $con = null) Return the first ChildPerfil matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPerfil requireOneByIdperfil(int $idPerfil) Return the first ChildPerfil filtered by the idPerfil column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerfil requireOneByInformacion(string $informacion) Return the first ChildPerfil filtered by the informacion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerfil requireOneByNacimiento(string $nacimiento) Return the first ChildPerfil filtered by the nacimiento column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerfil requireOneByGustos(string $gustos) Return the first ChildPerfil filtered by the gustos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPerfil[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPerfil objects based on current ModelCriteria
 * @method     ChildPerfil[]|ObjectCollection findByIdperfil(int $idPerfil) Return ChildPerfil objects filtered by the idPerfil column
 * @method     ChildPerfil[]|ObjectCollection findByInformacion(string $informacion) Return ChildPerfil objects filtered by the informacion column
 * @method     ChildPerfil[]|ObjectCollection findByNacimiento(string $nacimiento) Return ChildPerfil objects filtered by the nacimiento column
 * @method     ChildPerfil[]|ObjectCollection findByGustos(string $gustos) Return ChildPerfil objects filtered by the gustos column
 * @method     ChildPerfil[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PerfilQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PerfilQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'prueba', $modelName = '\\Perfil', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPerfilQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPerfilQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPerfilQuery) {
            return $criteria;
        }
        $query = new ChildPerfilQuery();
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
     * @return ChildPerfil|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PerfilTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PerfilTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPerfil A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idPerfil, informacion, nacimiento, gustos FROM Perfil WHERE idPerfil = :p0';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPerfil $obj */
            $obj = new ChildPerfil();
            $obj->hydrate($row);
            PerfilTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPerfil|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPerfilQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PerfilTableMap::COL_IDPERFIL, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPerfilQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PerfilTableMap::COL_IDPERFIL, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idPerfil column
     *
     * Example usage:
     * <code>
     * $query->filterByIdperfil(1234); // WHERE idPerfil = 1234
     * $query->filterByIdperfil(array(12, 34)); // WHERE idPerfil IN (12, 34)
     * $query->filterByIdperfil(array('min' => 12)); // WHERE idPerfil > 12
     * </code>
     *
     * @param     mixed $idperfil The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPerfilQuery The current query, for fluid interface
     */
    public function filterByIdperfil($idperfil = null, $comparison = null)
    {
        if (is_array($idperfil)) {
            $useMinMax = false;
            if (isset($idperfil['min'])) {
                $this->addUsingAlias(PerfilTableMap::COL_IDPERFIL, $idperfil['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idperfil['max'])) {
                $this->addUsingAlias(PerfilTableMap::COL_IDPERFIL, $idperfil['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PerfilTableMap::COL_IDPERFIL, $idperfil, $comparison);
    }

    /**
     * Filter the query on the informacion column
     *
     * Example usage:
     * <code>
     * $query->filterByInformacion('fooValue');   // WHERE informacion = 'fooValue'
     * $query->filterByInformacion('%fooValue%'); // WHERE informacion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $informacion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPerfilQuery The current query, for fluid interface
     */
    public function filterByInformacion($informacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($informacion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PerfilTableMap::COL_INFORMACION, $informacion, $comparison);
    }

    /**
     * Filter the query on the nacimiento column
     *
     * Example usage:
     * <code>
     * $query->filterByNacimiento('2011-03-14'); // WHERE nacimiento = '2011-03-14'
     * $query->filterByNacimiento('now'); // WHERE nacimiento = '2011-03-14'
     * $query->filterByNacimiento(array('max' => 'yesterday')); // WHERE nacimiento > '2011-03-13'
     * </code>
     *
     * @param     mixed $nacimiento The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPerfilQuery The current query, for fluid interface
     */
    public function filterByNacimiento($nacimiento = null, $comparison = null)
    {
        if (is_array($nacimiento)) {
            $useMinMax = false;
            if (isset($nacimiento['min'])) {
                $this->addUsingAlias(PerfilTableMap::COL_NACIMIENTO, $nacimiento['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nacimiento['max'])) {
                $this->addUsingAlias(PerfilTableMap::COL_NACIMIENTO, $nacimiento['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PerfilTableMap::COL_NACIMIENTO, $nacimiento, $comparison);
    }

    /**
     * Filter the query on the gustos column
     *
     * Example usage:
     * <code>
     * $query->filterByGustos('fooValue');   // WHERE gustos = 'fooValue'
     * $query->filterByGustos('%fooValue%'); // WHERE gustos LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gustos The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPerfilQuery The current query, for fluid interface
     */
    public function filterByGustos($gustos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gustos)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PerfilTableMap::COL_GUSTOS, $gustos, $comparison);
    }

    /**
     * Filter the query by a related \Usuario object
     *
     * @param \Usuario|ObjectCollection $usuario the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPerfilQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Usuario) {
            return $this
                ->addUsingAlias(PerfilTableMap::COL_IDPERFIL, $usuario->getFkperfil(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            return $this
                ->useUsuarioQuery()
                ->filterByPrimaryKeys($usuario->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildPerfilQuery The current query, for fluid interface
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
     * Filter the query by a related \Administrador object
     *
     * @param \Administrador|ObjectCollection $administrador the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPerfilQuery The current query, for fluid interface
     */
    public function filterByAdministrador($administrador, $comparison = null)
    {
        if ($administrador instanceof \Administrador) {
            return $this
                ->addUsingAlias(PerfilTableMap::COL_IDPERFIL, $administrador->getFkperfil(), $comparison);
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
     * @return $this|ChildPerfilQuery The current query, for fluid interface
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
     * @return ChildPerfilQuery The current query, for fluid interface
     */
    public function filterByColaborador($colaborador, $comparison = null)
    {
        if ($colaborador instanceof \Colaborador) {
            return $this
                ->addUsingAlias(PerfilTableMap::COL_IDPERFIL, $colaborador->getFkperfil(), $comparison);
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
     * @return $this|ChildPerfilQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildPerfil $perfil Object to remove from the list of results
     *
     * @return $this|ChildPerfilQuery The current query, for fluid interface
     */
    public function prune($perfil = null)
    {
        if ($perfil) {
            $this->addUsingAlias(PerfilTableMap::COL_IDPERFIL, $perfil->getIdperfil(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Perfil table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PerfilTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PerfilTableMap::clearInstancePool();
            PerfilTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PerfilTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PerfilTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            PerfilTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            PerfilTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PerfilQuery
