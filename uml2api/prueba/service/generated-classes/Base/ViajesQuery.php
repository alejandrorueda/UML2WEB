<?php

namespace Base;

use \Viajes as ChildViajes;
use \ViajesQuery as ChildViajesQuery;
use \Exception;
use \PDO;
use Map\ViajesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'viajes' table.
 *
 * 
 *
 * @method     ChildViajesQuery orderByIdusuario($order = Criteria::ASC) Order by the idUsuario column
 * @method     ChildViajesQuery orderByIdviaje($order = Criteria::ASC) Order by the idViaje column
 *
 * @method     ChildViajesQuery groupByIdusuario() Group by the idUsuario column
 * @method     ChildViajesQuery groupByIdviaje() Group by the idViaje column
 *
 * @method     ChildViajesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildViajesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildViajesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildViajesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildViajesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildViajesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildViajesQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildViajesQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildViajesQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildViajesQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildViajesQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildViajesQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildViajesQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     ChildViajesQuery leftJoinViaje($relationAlias = null) Adds a LEFT JOIN clause to the query using the Viaje relation
 * @method     ChildViajesQuery rightJoinViaje($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Viaje relation
 * @method     ChildViajesQuery innerJoinViaje($relationAlias = null) Adds a INNER JOIN clause to the query using the Viaje relation
 *
 * @method     ChildViajesQuery joinWithViaje($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Viaje relation
 *
 * @method     ChildViajesQuery leftJoinWithViaje() Adds a LEFT JOIN clause and with to the query using the Viaje relation
 * @method     ChildViajesQuery rightJoinWithViaje() Adds a RIGHT JOIN clause and with to the query using the Viaje relation
 * @method     ChildViajesQuery innerJoinWithViaje() Adds a INNER JOIN clause and with to the query using the Viaje relation
 *
 * @method     \UsuarioQuery|\ViajeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildViajes findOne(ConnectionInterface $con = null) Return the first ChildViajes matching the query
 * @method     ChildViajes findOneOrCreate(ConnectionInterface $con = null) Return the first ChildViajes matching the query, or a new ChildViajes object populated from the query conditions when no match is found
 *
 * @method     ChildViajes findOneByIdusuario(string $idUsuario) Return the first ChildViajes filtered by the idUsuario column
 * @method     ChildViajes findOneByIdviaje(int $idViaje) Return the first ChildViajes filtered by the idViaje column *

 * @method     ChildViajes requirePk($key, ConnectionInterface $con = null) Return the ChildViajes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildViajes requireOne(ConnectionInterface $con = null) Return the first ChildViajes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildViajes requireOneByIdusuario(string $idUsuario) Return the first ChildViajes filtered by the idUsuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildViajes requireOneByIdviaje(int $idViaje) Return the first ChildViajes filtered by the idViaje column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildViajes[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildViajes objects based on current ModelCriteria
 * @method     ChildViajes[]|ObjectCollection findByIdusuario(string $idUsuario) Return ChildViajes objects filtered by the idUsuario column
 * @method     ChildViajes[]|ObjectCollection findByIdviaje(int $idViaje) Return ChildViajes objects filtered by the idViaje column
 * @method     ChildViajes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ViajesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ViajesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'prueba', $modelName = '\\Viajes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildViajesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildViajesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildViajesQuery) {
            return $criteria;
        }
        $query = new ChildViajesQuery();
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
     * @param array[$idUsuario, $idViaje] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildViajes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ViajesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ViajesTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildViajes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idUsuario, idViaje FROM viajes WHERE idUsuario = :p0 AND idViaje = :p1';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);            
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildViajes $obj */
            $obj = new ChildViajes();
            $obj->hydrate($row);
            ViajesTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildViajes|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildViajesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ViajesTableMap::COL_IDUSUARIO, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ViajesTableMap::COL_IDVIAJE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildViajesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ViajesTableMap::COL_IDUSUARIO, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ViajesTableMap::COL_IDVIAJE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the idUsuario column
     *
     * Example usage:
     * <code>
     * $query->filterByIdusuario('fooValue');   // WHERE idUsuario = 'fooValue'
     * $query->filterByIdusuario('%fooValue%'); // WHERE idUsuario LIKE '%fooValue%'
     * </code>
     *
     * @param     string $idusuario The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildViajesQuery The current query, for fluid interface
     */
    public function filterByIdusuario($idusuario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idusuario)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ViajesTableMap::COL_IDUSUARIO, $idusuario, $comparison);
    }

    /**
     * Filter the query on the idViaje column
     *
     * Example usage:
     * <code>
     * $query->filterByIdviaje(1234); // WHERE idViaje = 1234
     * $query->filterByIdviaje(array(12, 34)); // WHERE idViaje IN (12, 34)
     * $query->filterByIdviaje(array('min' => 12)); // WHERE idViaje > 12
     * </code>
     *
     * @see       filterByViaje()
     *
     * @param     mixed $idviaje The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildViajesQuery The current query, for fluid interface
     */
    public function filterByIdviaje($idviaje = null, $comparison = null)
    {
        if (is_array($idviaje)) {
            $useMinMax = false;
            if (isset($idviaje['min'])) {
                $this->addUsingAlias(ViajesTableMap::COL_IDVIAJE, $idviaje['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idviaje['max'])) {
                $this->addUsingAlias(ViajesTableMap::COL_IDVIAJE, $idviaje['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ViajesTableMap::COL_IDVIAJE, $idviaje, $comparison);
    }

    /**
     * Filter the query by a related \Usuario object
     *
     * @param \Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildViajesQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Usuario) {
            return $this
                ->addUsingAlias(ViajesTableMap::COL_IDUSUARIO, $usuario->getIdusuario(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ViajesTableMap::COL_IDUSUARIO, $usuario->toKeyValue('PrimaryKey', 'Idusuario'), $comparison);
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
     * @return $this|ChildViajesQuery The current query, for fluid interface
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
     * Filter the query by a related \Viaje object
     *
     * @param \Viaje|ObjectCollection $viaje The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildViajesQuery The current query, for fluid interface
     */
    public function filterByViaje($viaje, $comparison = null)
    {
        if ($viaje instanceof \Viaje) {
            return $this
                ->addUsingAlias(ViajesTableMap::COL_IDVIAJE, $viaje->getIdviaje(), $comparison);
        } elseif ($viaje instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ViajesTableMap::COL_IDVIAJE, $viaje->toKeyValue('PrimaryKey', 'Idviaje'), $comparison);
        } else {
            throw new PropelException('filterByViaje() only accepts arguments of type \Viaje or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Viaje relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildViajesQuery The current query, for fluid interface
     */
    public function joinViaje($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Viaje');

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
            $this->addJoinObject($join, 'Viaje');
        }

        return $this;
    }

    /**
     * Use the Viaje relation Viaje object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ViajeQuery A secondary query class using the current class as primary query
     */
    public function useViajeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinViaje($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Viaje', '\ViajeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildViajes $viajes Object to remove from the list of results
     *
     * @return $this|ChildViajesQuery The current query, for fluid interface
     */
    public function prune($viajes = null)
    {
        if ($viajes) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ViajesTableMap::COL_IDUSUARIO), $viajes->getIdusuario(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ViajesTableMap::COL_IDVIAJE), $viajes->getIdviaje(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the viajes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ViajesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ViajesTableMap::clearInstancePool();
            ViajesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ViajesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ViajesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ViajesTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ViajesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ViajesQuery
