<?php

namespace Base;

use \UsuarioGrupos as ChildUsuarioGrupos;
use \UsuarioGruposQuery as ChildUsuarioGruposQuery;
use \Exception;
use \PDO;
use Map\UsuarioGruposTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Usuario_grupos' table.
 *
 * 
 *
 * @method     ChildUsuarioGruposQuery orderByIdusuario($order = Criteria::ASC) Order by the idUsuario column
 * @method     ChildUsuarioGruposQuery orderByIdgrupo($order = Criteria::ASC) Order by the idGrupo column
 *
 * @method     ChildUsuarioGruposQuery groupByIdusuario() Group by the idUsuario column
 * @method     ChildUsuarioGruposQuery groupByIdgrupo() Group by the idGrupo column
 *
 * @method     ChildUsuarioGruposQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsuarioGruposQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsuarioGruposQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsuarioGruposQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsuarioGruposQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsuarioGruposQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsuarioGruposQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildUsuarioGruposQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildUsuarioGruposQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildUsuarioGruposQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildUsuarioGruposQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildUsuarioGruposQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildUsuarioGruposQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     ChildUsuarioGruposQuery leftJoinGrupo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Grupo relation
 * @method     ChildUsuarioGruposQuery rightJoinGrupo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Grupo relation
 * @method     ChildUsuarioGruposQuery innerJoinGrupo($relationAlias = null) Adds a INNER JOIN clause to the query using the Grupo relation
 *
 * @method     ChildUsuarioGruposQuery joinWithGrupo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Grupo relation
 *
 * @method     ChildUsuarioGruposQuery leftJoinWithGrupo() Adds a LEFT JOIN clause and with to the query using the Grupo relation
 * @method     ChildUsuarioGruposQuery rightJoinWithGrupo() Adds a RIGHT JOIN clause and with to the query using the Grupo relation
 * @method     ChildUsuarioGruposQuery innerJoinWithGrupo() Adds a INNER JOIN clause and with to the query using the Grupo relation
 *
 * @method     \UsuarioQuery|\GrupoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsuarioGrupos findOne(ConnectionInterface $con = null) Return the first ChildUsuarioGrupos matching the query
 * @method     ChildUsuarioGrupos findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsuarioGrupos matching the query, or a new ChildUsuarioGrupos object populated from the query conditions when no match is found
 *
 * @method     ChildUsuarioGrupos findOneByIdusuario(string $idUsuario) Return the first ChildUsuarioGrupos filtered by the idUsuario column
 * @method     ChildUsuarioGrupos findOneByIdgrupo(int $idGrupo) Return the first ChildUsuarioGrupos filtered by the idGrupo column *

 * @method     ChildUsuarioGrupos requirePk($key, ConnectionInterface $con = null) Return the ChildUsuarioGrupos by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarioGrupos requireOne(ConnectionInterface $con = null) Return the first ChildUsuarioGrupos matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuarioGrupos requireOneByIdusuario(string $idUsuario) Return the first ChildUsuarioGrupos filtered by the idUsuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarioGrupos requireOneByIdgrupo(int $idGrupo) Return the first ChildUsuarioGrupos filtered by the idGrupo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuarioGrupos[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsuarioGrupos objects based on current ModelCriteria
 * @method     ChildUsuarioGrupos[]|ObjectCollection findByIdusuario(string $idUsuario) Return ChildUsuarioGrupos objects filtered by the idUsuario column
 * @method     ChildUsuarioGrupos[]|ObjectCollection findByIdgrupo(int $idGrupo) Return ChildUsuarioGrupos objects filtered by the idGrupo column
 * @method     ChildUsuarioGrupos[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsuarioGruposQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsuarioGruposQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'prueba', $modelName = '\\UsuarioGrupos', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsuarioGruposQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsuarioGruposQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsuarioGruposQuery) {
            return $criteria;
        }
        $query = new ChildUsuarioGruposQuery();
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
     * @param array[$idUsuario, $idGrupo] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUsuarioGrupos|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsuarioGruposTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsuarioGruposTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildUsuarioGrupos A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idUsuario, idGrupo FROM Usuario_grupos WHERE idUsuario = :p0 AND idGrupo = :p1';
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
            /** @var ChildUsuarioGrupos $obj */
            $obj = new ChildUsuarioGrupos();
            $obj->hydrate($row);
            UsuarioGruposTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildUsuarioGrupos|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsuarioGruposQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(UsuarioGruposTableMap::COL_IDUSUARIO, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(UsuarioGruposTableMap::COL_IDGRUPO, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsuarioGruposQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(UsuarioGruposTableMap::COL_IDUSUARIO, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(UsuarioGruposTableMap::COL_IDGRUPO, $key[1], Criteria::EQUAL);
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
     * @return $this|ChildUsuarioGruposQuery The current query, for fluid interface
     */
    public function filterByIdusuario($idusuario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idusuario)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioGruposTableMap::COL_IDUSUARIO, $idusuario, $comparison);
    }

    /**
     * Filter the query on the idGrupo column
     *
     * Example usage:
     * <code>
     * $query->filterByIdgrupo(1234); // WHERE idGrupo = 1234
     * $query->filterByIdgrupo(array(12, 34)); // WHERE idGrupo IN (12, 34)
     * $query->filterByIdgrupo(array('min' => 12)); // WHERE idGrupo > 12
     * </code>
     *
     * @see       filterByGrupo()
     *
     * @param     mixed $idgrupo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioGruposQuery The current query, for fluid interface
     */
    public function filterByIdgrupo($idgrupo = null, $comparison = null)
    {
        if (is_array($idgrupo)) {
            $useMinMax = false;
            if (isset($idgrupo['min'])) {
                $this->addUsingAlias(UsuarioGruposTableMap::COL_IDGRUPO, $idgrupo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idgrupo['max'])) {
                $this->addUsingAlias(UsuarioGruposTableMap::COL_IDGRUPO, $idgrupo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioGruposTableMap::COL_IDGRUPO, $idgrupo, $comparison);
    }

    /**
     * Filter the query by a related \Usuario object
     *
     * @param \Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUsuarioGruposQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Usuario) {
            return $this
                ->addUsingAlias(UsuarioGruposTableMap::COL_IDUSUARIO, $usuario->getIdusuario(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsuarioGruposTableMap::COL_IDUSUARIO, $usuario->toKeyValue('PrimaryKey', 'Idusuario'), $comparison);
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
     * @return $this|ChildUsuarioGruposQuery The current query, for fluid interface
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
     * Filter the query by a related \Grupo object
     *
     * @param \Grupo|ObjectCollection $grupo The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUsuarioGruposQuery The current query, for fluid interface
     */
    public function filterByGrupo($grupo, $comparison = null)
    {
        if ($grupo instanceof \Grupo) {
            return $this
                ->addUsingAlias(UsuarioGruposTableMap::COL_IDGRUPO, $grupo->getIdgrupo(), $comparison);
        } elseif ($grupo instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsuarioGruposTableMap::COL_IDGRUPO, $grupo->toKeyValue('PrimaryKey', 'Idgrupo'), $comparison);
        } else {
            throw new PropelException('filterByGrupo() only accepts arguments of type \Grupo or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Grupo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioGruposQuery The current query, for fluid interface
     */
    public function joinGrupo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Grupo');

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
            $this->addJoinObject($join, 'Grupo');
        }

        return $this;
    }

    /**
     * Use the Grupo relation Grupo object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GrupoQuery A secondary query class using the current class as primary query
     */
    public function useGrupoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGrupo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Grupo', '\GrupoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsuarioGrupos $usuarioGrupos Object to remove from the list of results
     *
     * @return $this|ChildUsuarioGruposQuery The current query, for fluid interface
     */
    public function prune($usuarioGrupos = null)
    {
        if ($usuarioGrupos) {
            $this->addCond('pruneCond0', $this->getAliasedColName(UsuarioGruposTableMap::COL_IDUSUARIO), $usuarioGrupos->getIdusuario(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(UsuarioGruposTableMap::COL_IDGRUPO), $usuarioGrupos->getIdgrupo(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Usuario_grupos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioGruposTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsuarioGruposTableMap::clearInstancePool();
            UsuarioGruposTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioGruposTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsuarioGruposTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            UsuarioGruposTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            UsuarioGruposTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsuarioGruposQuery
