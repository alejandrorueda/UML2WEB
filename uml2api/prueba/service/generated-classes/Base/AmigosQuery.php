<?php

namespace Base;

use \Amigos as ChildAmigos;
use \AmigosQuery as ChildAmigosQuery;
use \Exception;
use \PDO;
use Map\AmigosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'amigos' table.
 *
 * 
 *
 * @method     ChildAmigosQuery orderByIdusuario($order = Criteria::ASC) Order by the idUsuario column
 * @method     ChildAmigosQuery orderByRelacionusuario($order = Criteria::ASC) Order by the relacionusuario column
 *
 * @method     ChildAmigosQuery groupByIdusuario() Group by the idUsuario column
 * @method     ChildAmigosQuery groupByRelacionusuario() Group by the relacionusuario column
 *
 * @method     ChildAmigosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAmigosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAmigosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAmigosQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAmigosQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAmigosQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAmigosQuery leftJoinUsuarioRelatedByIdusuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioRelatedByIdusuario relation
 * @method     ChildAmigosQuery rightJoinUsuarioRelatedByIdusuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioRelatedByIdusuario relation
 * @method     ChildAmigosQuery innerJoinUsuarioRelatedByIdusuario($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioRelatedByIdusuario relation
 *
 * @method     ChildAmigosQuery joinWithUsuarioRelatedByIdusuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsuarioRelatedByIdusuario relation
 *
 * @method     ChildAmigosQuery leftJoinWithUsuarioRelatedByIdusuario() Adds a LEFT JOIN clause and with to the query using the UsuarioRelatedByIdusuario relation
 * @method     ChildAmigosQuery rightJoinWithUsuarioRelatedByIdusuario() Adds a RIGHT JOIN clause and with to the query using the UsuarioRelatedByIdusuario relation
 * @method     ChildAmigosQuery innerJoinWithUsuarioRelatedByIdusuario() Adds a INNER JOIN clause and with to the query using the UsuarioRelatedByIdusuario relation
 *
 * @method     ChildAmigosQuery leftJoinUsuarioRelatedByRelacionusuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioRelatedByRelacionusuario relation
 * @method     ChildAmigosQuery rightJoinUsuarioRelatedByRelacionusuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioRelatedByRelacionusuario relation
 * @method     ChildAmigosQuery innerJoinUsuarioRelatedByRelacionusuario($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioRelatedByRelacionusuario relation
 *
 * @method     ChildAmigosQuery joinWithUsuarioRelatedByRelacionusuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsuarioRelatedByRelacionusuario relation
 *
 * @method     ChildAmigosQuery leftJoinWithUsuarioRelatedByRelacionusuario() Adds a LEFT JOIN clause and with to the query using the UsuarioRelatedByRelacionusuario relation
 * @method     ChildAmigosQuery rightJoinWithUsuarioRelatedByRelacionusuario() Adds a RIGHT JOIN clause and with to the query using the UsuarioRelatedByRelacionusuario relation
 * @method     ChildAmigosQuery innerJoinWithUsuarioRelatedByRelacionusuario() Adds a INNER JOIN clause and with to the query using the UsuarioRelatedByRelacionusuario relation
 *
 * @method     \UsuarioQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAmigos findOne(ConnectionInterface $con = null) Return the first ChildAmigos matching the query
 * @method     ChildAmigos findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAmigos matching the query, or a new ChildAmigos object populated from the query conditions when no match is found
 *
 * @method     ChildAmigos findOneByIdusuario(string $idUsuario) Return the first ChildAmigos filtered by the idUsuario column
 * @method     ChildAmigos findOneByRelacionusuario(string $relacionusuario) Return the first ChildAmigos filtered by the relacionusuario column *

 * @method     ChildAmigos requirePk($key, ConnectionInterface $con = null) Return the ChildAmigos by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAmigos requireOne(ConnectionInterface $con = null) Return the first ChildAmigos matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAmigos requireOneByIdusuario(string $idUsuario) Return the first ChildAmigos filtered by the idUsuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAmigos requireOneByRelacionusuario(string $relacionusuario) Return the first ChildAmigos filtered by the relacionusuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAmigos[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAmigos objects based on current ModelCriteria
 * @method     ChildAmigos[]|ObjectCollection findByIdusuario(string $idUsuario) Return ChildAmigos objects filtered by the idUsuario column
 * @method     ChildAmigos[]|ObjectCollection findByRelacionusuario(string $relacionusuario) Return ChildAmigos objects filtered by the relacionusuario column
 * @method     ChildAmigos[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AmigosQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\AmigosQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'prueba', $modelName = '\\Amigos', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAmigosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAmigosQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAmigosQuery) {
            return $criteria;
        }
        $query = new ChildAmigosQuery();
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
     * @param array[$idUsuario, $relacionusuario] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildAmigos|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AmigosTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AmigosTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildAmigos A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idUsuario, relacionusuario FROM amigos WHERE idUsuario = :p0 AND relacionusuario = :p1';
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
            /** @var ChildAmigos $obj */
            $obj = new ChildAmigos();
            $obj->hydrate($row);
            AmigosTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildAmigos|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAmigosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(AmigosTableMap::COL_IDUSUARIO, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(AmigosTableMap::COL_RELACIONUSUARIO, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAmigosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(AmigosTableMap::COL_IDUSUARIO, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(AmigosTableMap::COL_RELACIONUSUARIO, $key[1], Criteria::EQUAL);
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
     * @return $this|ChildAmigosQuery The current query, for fluid interface
     */
    public function filterByIdusuario($idusuario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idusuario)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AmigosTableMap::COL_IDUSUARIO, $idusuario, $comparison);
    }

    /**
     * Filter the query on the relacionusuario column
     *
     * Example usage:
     * <code>
     * $query->filterByRelacionusuario('fooValue');   // WHERE relacionusuario = 'fooValue'
     * $query->filterByRelacionusuario('%fooValue%'); // WHERE relacionusuario LIKE '%fooValue%'
     * </code>
     *
     * @param     string $relacionusuario The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAmigosQuery The current query, for fluid interface
     */
    public function filterByRelacionusuario($relacionusuario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($relacionusuario)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AmigosTableMap::COL_RELACIONUSUARIO, $relacionusuario, $comparison);
    }

    /**
     * Filter the query by a related \Usuario object
     *
     * @param \Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAmigosQuery The current query, for fluid interface
     */
    public function filterByUsuarioRelatedByIdusuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Usuario) {
            return $this
                ->addUsingAlias(AmigosTableMap::COL_IDUSUARIO, $usuario->getIdusuario(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AmigosTableMap::COL_IDUSUARIO, $usuario->toKeyValue('PrimaryKey', 'Idusuario'), $comparison);
        } else {
            throw new PropelException('filterByUsuarioRelatedByIdusuario() only accepts arguments of type \Usuario or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsuarioRelatedByIdusuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAmigosQuery The current query, for fluid interface
     */
    public function joinUsuarioRelatedByIdusuario($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsuarioRelatedByIdusuario');

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
            $this->addJoinObject($join, 'UsuarioRelatedByIdusuario');
        }

        return $this;
    }

    /**
     * Use the UsuarioRelatedByIdusuario relation Usuario object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsuarioQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioRelatedByIdusuarioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuarioRelatedByIdusuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsuarioRelatedByIdusuario', '\UsuarioQuery');
    }

    /**
     * Filter the query by a related \Usuario object
     *
     * @param \Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAmigosQuery The current query, for fluid interface
     */
    public function filterByUsuarioRelatedByRelacionusuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Usuario) {
            return $this
                ->addUsingAlias(AmigosTableMap::COL_RELACIONUSUARIO, $usuario->getIdusuario(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AmigosTableMap::COL_RELACIONUSUARIO, $usuario->toKeyValue('PrimaryKey', 'Idusuario'), $comparison);
        } else {
            throw new PropelException('filterByUsuarioRelatedByRelacionusuario() only accepts arguments of type \Usuario or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsuarioRelatedByRelacionusuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAmigosQuery The current query, for fluid interface
     */
    public function joinUsuarioRelatedByRelacionusuario($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsuarioRelatedByRelacionusuario');

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
            $this->addJoinObject($join, 'UsuarioRelatedByRelacionusuario');
        }

        return $this;
    }

    /**
     * Use the UsuarioRelatedByRelacionusuario relation Usuario object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsuarioQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioRelatedByRelacionusuarioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuarioRelatedByRelacionusuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsuarioRelatedByRelacionusuario', '\UsuarioQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAmigos $amigos Object to remove from the list of results
     *
     * @return $this|ChildAmigosQuery The current query, for fluid interface
     */
    public function prune($amigos = null)
    {
        if ($amigos) {
            $this->addCond('pruneCond0', $this->getAliasedColName(AmigosTableMap::COL_IDUSUARIO), $amigos->getIdusuario(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(AmigosTableMap::COL_RELACIONUSUARIO), $amigos->getRelacionusuario(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the amigos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AmigosTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AmigosTableMap::clearInstancePool();
            AmigosTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AmigosTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AmigosTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            AmigosTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            AmigosTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AmigosQuery
