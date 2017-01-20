<?php

namespace Base;

use \Invitacion as ChildInvitacion;
use \InvitacionQuery as ChildInvitacionQuery;
use \Exception;
use \PDO;
use Map\InvitacionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Invitacion' table.
 *
 * 
 *
 * @method     ChildInvitacionQuery orderByIdinvitacion($order = Criteria::ASC) Order by the idInvitacion column
 * @method     ChildInvitacionQuery orderByCodigo($order = Criteria::ASC) Order by the codigo column
 * @method     ChildInvitacionQuery orderByActivo($order = Criteria::ASC) Order by the activo column
 * @method     ChildInvitacionQuery orderByFkusuario($order = Criteria::ASC) Order by the fkusuario column
 *
 * @method     ChildInvitacionQuery groupByIdinvitacion() Group by the idInvitacion column
 * @method     ChildInvitacionQuery groupByCodigo() Group by the codigo column
 * @method     ChildInvitacionQuery groupByActivo() Group by the activo column
 * @method     ChildInvitacionQuery groupByFkusuario() Group by the fkusuario column
 *
 * @method     ChildInvitacionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildInvitacionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildInvitacionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildInvitacionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildInvitacionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildInvitacionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildInvitacionQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildInvitacionQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildInvitacionQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildInvitacionQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildInvitacionQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildInvitacionQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildInvitacionQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     \UsuarioQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildInvitacion findOne(ConnectionInterface $con = null) Return the first ChildInvitacion matching the query
 * @method     ChildInvitacion findOneOrCreate(ConnectionInterface $con = null) Return the first ChildInvitacion matching the query, or a new ChildInvitacion object populated from the query conditions when no match is found
 *
 * @method     ChildInvitacion findOneByIdinvitacion(int $idInvitacion) Return the first ChildInvitacion filtered by the idInvitacion column
 * @method     ChildInvitacion findOneByCodigo(string $codigo) Return the first ChildInvitacion filtered by the codigo column
 * @method     ChildInvitacion findOneByActivo(boolean $activo) Return the first ChildInvitacion filtered by the activo column
 * @method     ChildInvitacion findOneByFkusuario(string $fkusuario) Return the first ChildInvitacion filtered by the fkusuario column *

 * @method     ChildInvitacion requirePk($key, ConnectionInterface $con = null) Return the ChildInvitacion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvitacion requireOne(ConnectionInterface $con = null) Return the first ChildInvitacion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInvitacion requireOneByIdinvitacion(int $idInvitacion) Return the first ChildInvitacion filtered by the idInvitacion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvitacion requireOneByCodigo(string $codigo) Return the first ChildInvitacion filtered by the codigo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvitacion requireOneByActivo(boolean $activo) Return the first ChildInvitacion filtered by the activo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvitacion requireOneByFkusuario(string $fkusuario) Return the first ChildInvitacion filtered by the fkusuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInvitacion[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildInvitacion objects based on current ModelCriteria
 * @method     ChildInvitacion[]|ObjectCollection findByIdinvitacion(int $idInvitacion) Return ChildInvitacion objects filtered by the idInvitacion column
 * @method     ChildInvitacion[]|ObjectCollection findByCodigo(string $codigo) Return ChildInvitacion objects filtered by the codigo column
 * @method     ChildInvitacion[]|ObjectCollection findByActivo(boolean $activo) Return ChildInvitacion objects filtered by the activo column
 * @method     ChildInvitacion[]|ObjectCollection findByFkusuario(string $fkusuario) Return ChildInvitacion objects filtered by the fkusuario column
 * @method     ChildInvitacion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class InvitacionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\InvitacionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'prueba', $modelName = '\\Invitacion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildInvitacionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildInvitacionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildInvitacionQuery) {
            return $criteria;
        }
        $query = new ChildInvitacionQuery();
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
     * @return ChildInvitacion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(InvitacionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = InvitacionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildInvitacion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idInvitacion, codigo, activo, fkusuario FROM Invitacion WHERE idInvitacion = :p0';
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
            /** @var ChildInvitacion $obj */
            $obj = new ChildInvitacion();
            $obj->hydrate($row);
            InvitacionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildInvitacion|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildInvitacionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(InvitacionTableMap::COL_IDINVITACION, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildInvitacionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(InvitacionTableMap::COL_IDINVITACION, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idInvitacion column
     *
     * Example usage:
     * <code>
     * $query->filterByIdinvitacion(1234); // WHERE idInvitacion = 1234
     * $query->filterByIdinvitacion(array(12, 34)); // WHERE idInvitacion IN (12, 34)
     * $query->filterByIdinvitacion(array('min' => 12)); // WHERE idInvitacion > 12
     * </code>
     *
     * @param     mixed $idinvitacion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvitacionQuery The current query, for fluid interface
     */
    public function filterByIdinvitacion($idinvitacion = null, $comparison = null)
    {
        if (is_array($idinvitacion)) {
            $useMinMax = false;
            if (isset($idinvitacion['min'])) {
                $this->addUsingAlias(InvitacionTableMap::COL_IDINVITACION, $idinvitacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idinvitacion['max'])) {
                $this->addUsingAlias(InvitacionTableMap::COL_IDINVITACION, $idinvitacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvitacionTableMap::COL_IDINVITACION, $idinvitacion, $comparison);
    }

    /**
     * Filter the query on the codigo column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigo('fooValue');   // WHERE codigo = 'fooValue'
     * $query->filterByCodigo('%fooValue%'); // WHERE codigo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codigo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvitacionQuery The current query, for fluid interface
     */
    public function filterByCodigo($codigo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvitacionTableMap::COL_CODIGO, $codigo, $comparison);
    }

    /**
     * Filter the query on the activo column
     *
     * Example usage:
     * <code>
     * $query->filterByActivo(true); // WHERE activo = true
     * $query->filterByActivo('yes'); // WHERE activo = true
     * </code>
     *
     * @param     boolean|string $activo The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvitacionQuery The current query, for fluid interface
     */
    public function filterByActivo($activo = null, $comparison = null)
    {
        if (is_string($activo)) {
            $activo = in_array(strtolower($activo), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(InvitacionTableMap::COL_ACTIVO, $activo, $comparison);
    }

    /**
     * Filter the query on the fkusuario column
     *
     * Example usage:
     * <code>
     * $query->filterByFkusuario('fooValue');   // WHERE fkusuario = 'fooValue'
     * $query->filterByFkusuario('%fooValue%'); // WHERE fkusuario LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fkusuario The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvitacionQuery The current query, for fluid interface
     */
    public function filterByFkusuario($fkusuario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fkusuario)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvitacionTableMap::COL_FKUSUARIO, $fkusuario, $comparison);
    }

    /**
     * Filter the query by a related \Usuario object
     *
     * @param \Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildInvitacionQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Usuario) {
            return $this
                ->addUsingAlias(InvitacionTableMap::COL_FKUSUARIO, $usuario->getIdusuario(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InvitacionTableMap::COL_FKUSUARIO, $usuario->toKeyValue('PrimaryKey', 'Idusuario'), $comparison);
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
     * @return $this|ChildInvitacionQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildInvitacion $invitacion Object to remove from the list of results
     *
     * @return $this|ChildInvitacionQuery The current query, for fluid interface
     */
    public function prune($invitacion = null)
    {
        if ($invitacion) {
            $this->addUsingAlias(InvitacionTableMap::COL_IDINVITACION, $invitacion->getIdinvitacion(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Invitacion table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InvitacionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            InvitacionTableMap::clearInstancePool();
            InvitacionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(InvitacionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(InvitacionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            InvitacionTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            InvitacionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // InvitacionQuery
