<?php

namespace Base;

use \Grupo as ChildGrupo;
use \GrupoQuery as ChildGrupoQuery;
use \Exception;
use \PDO;
use Map\GrupoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Grupo' table.
 *
 * 
 *
 * @method     ChildGrupoQuery orderByIdgrupo($order = Criteria::ASC) Order by the idGrupo column
 * @method     ChildGrupoQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 * @method     ChildGrupoQuery orderByInformacion($order = Criteria::ASC) Order by the informacion column
 *
 * @method     ChildGrupoQuery groupByIdgrupo() Group by the idGrupo column
 * @method     ChildGrupoQuery groupByNombre() Group by the nombre column
 * @method     ChildGrupoQuery groupByInformacion() Group by the informacion column
 *
 * @method     ChildGrupoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGrupoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGrupoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGrupoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGrupoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGrupoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGrupoQuery leftJoinUsuarioGrupos($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioGrupos relation
 * @method     ChildGrupoQuery rightJoinUsuarioGrupos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioGrupos relation
 * @method     ChildGrupoQuery innerJoinUsuarioGrupos($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioGrupos relation
 *
 * @method     ChildGrupoQuery joinWithUsuarioGrupos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsuarioGrupos relation
 *
 * @method     ChildGrupoQuery leftJoinWithUsuarioGrupos() Adds a LEFT JOIN clause and with to the query using the UsuarioGrupos relation
 * @method     ChildGrupoQuery rightJoinWithUsuarioGrupos() Adds a RIGHT JOIN clause and with to the query using the UsuarioGrupos relation
 * @method     ChildGrupoQuery innerJoinWithUsuarioGrupos() Adds a INNER JOIN clause and with to the query using the UsuarioGrupos relation
 *
 * @method     ChildGrupoQuery leftJoinGrupoViaje($relationAlias = null) Adds a LEFT JOIN clause to the query using the GrupoViaje relation
 * @method     ChildGrupoQuery rightJoinGrupoViaje($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GrupoViaje relation
 * @method     ChildGrupoQuery innerJoinGrupoViaje($relationAlias = null) Adds a INNER JOIN clause to the query using the GrupoViaje relation
 *
 * @method     ChildGrupoQuery joinWithGrupoViaje($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GrupoViaje relation
 *
 * @method     ChildGrupoQuery leftJoinWithGrupoViaje() Adds a LEFT JOIN clause and with to the query using the GrupoViaje relation
 * @method     ChildGrupoQuery rightJoinWithGrupoViaje() Adds a RIGHT JOIN clause and with to the query using the GrupoViaje relation
 * @method     ChildGrupoQuery innerJoinWithGrupoViaje() Adds a INNER JOIN clause and with to the query using the GrupoViaje relation
 *
 * @method     \UsuarioGruposQuery|\GrupoViajeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGrupo findOne(ConnectionInterface $con = null) Return the first ChildGrupo matching the query
 * @method     ChildGrupo findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGrupo matching the query, or a new ChildGrupo object populated from the query conditions when no match is found
 *
 * @method     ChildGrupo findOneByIdgrupo(int $idGrupo) Return the first ChildGrupo filtered by the idGrupo column
 * @method     ChildGrupo findOneByNombre(string $nombre) Return the first ChildGrupo filtered by the nombre column
 * @method     ChildGrupo findOneByInformacion(string $informacion) Return the first ChildGrupo filtered by the informacion column *

 * @method     ChildGrupo requirePk($key, ConnectionInterface $con = null) Return the ChildGrupo by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupo requireOne(ConnectionInterface $con = null) Return the first ChildGrupo matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGrupo requireOneByIdgrupo(int $idGrupo) Return the first ChildGrupo filtered by the idGrupo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupo requireOneByNombre(string $nombre) Return the first ChildGrupo filtered by the nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupo requireOneByInformacion(string $informacion) Return the first ChildGrupo filtered by the informacion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGrupo[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGrupo objects based on current ModelCriteria
 * @method     ChildGrupo[]|ObjectCollection findByIdgrupo(int $idGrupo) Return ChildGrupo objects filtered by the idGrupo column
 * @method     ChildGrupo[]|ObjectCollection findByNombre(string $nombre) Return ChildGrupo objects filtered by the nombre column
 * @method     ChildGrupo[]|ObjectCollection findByInformacion(string $informacion) Return ChildGrupo objects filtered by the informacion column
 * @method     ChildGrupo[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GrupoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\GrupoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'prueba', $modelName = '\\Grupo', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGrupoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGrupoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGrupoQuery) {
            return $criteria;
        }
        $query = new ChildGrupoQuery();
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
     * @return ChildGrupo|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GrupoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GrupoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGrupo A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idGrupo, nombre, informacion FROM Grupo WHERE idGrupo = :p0';
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
            /** @var ChildGrupo $obj */
            $obj = new ChildGrupo();
            $obj->hydrate($row);
            GrupoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGrupo|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GrupoTableMap::COL_IDGRUPO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GrupoTableMap::COL_IDGRUPO, $keys, Criteria::IN);
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
     * @param     mixed $idgrupo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByIdgrupo($idgrupo = null, $comparison = null)
    {
        if (is_array($idgrupo)) {
            $useMinMax = false;
            if (isset($idgrupo['min'])) {
                $this->addUsingAlias(GrupoTableMap::COL_IDGRUPO, $idgrupo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idgrupo['max'])) {
                $this->addUsingAlias(GrupoTableMap::COL_IDGRUPO, $idgrupo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoTableMap::COL_IDGRUPO, $idgrupo, $comparison);
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
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoTableMap::COL_NOMBRE, $nombre, $comparison);
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
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByInformacion($informacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($informacion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoTableMap::COL_INFORMACION, $informacion, $comparison);
    }

    /**
     * Filter the query by a related \UsuarioGrupos object
     *
     * @param \UsuarioGrupos|ObjectCollection $usuarioGrupos the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByUsuarioGrupos($usuarioGrupos, $comparison = null)
    {
        if ($usuarioGrupos instanceof \UsuarioGrupos) {
            return $this
                ->addUsingAlias(GrupoTableMap::COL_IDGRUPO, $usuarioGrupos->getIdgrupo(), $comparison);
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
     * @return $this|ChildGrupoQuery The current query, for fluid interface
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
     * Filter the query by a related \GrupoViaje object
     *
     * @param \GrupoViaje|ObjectCollection $grupoViaje the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByGrupoViaje($grupoViaje, $comparison = null)
    {
        if ($grupoViaje instanceof \GrupoViaje) {
            return $this
                ->addUsingAlias(GrupoTableMap::COL_IDGRUPO, $grupoViaje->getIdgrupo(), $comparison);
        } elseif ($grupoViaje instanceof ObjectCollection) {
            return $this
                ->useGrupoViajeQuery()
                ->filterByPrimaryKeys($grupoViaje->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGrupoViaje() only accepts arguments of type \GrupoViaje or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GrupoViaje relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function joinGrupoViaje($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GrupoViaje');

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
            $this->addJoinObject($join, 'GrupoViaje');
        }

        return $this;
    }

    /**
     * Use the GrupoViaje relation GrupoViaje object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GrupoViajeQuery A secondary query class using the current class as primary query
     */
    public function useGrupoViajeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGrupoViaje($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GrupoViaje', '\GrupoViajeQuery');
    }

    /**
     * Filter the query by a related Usuario object
     * using the Usuario_grupos table as cross reference
     *
     * @param Usuario $usuario the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useUsuarioGruposQuery()
            ->filterByUsuario($usuario, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Viaje object
     * using the Grupo_viaje table as cross reference
     *
     * @param Viaje $viaje the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByViaje($viaje, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGrupoViajeQuery()
            ->filterByViaje($viaje, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGrupo $grupo Object to remove from the list of results
     *
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function prune($grupo = null)
    {
        if ($grupo) {
            $this->addUsingAlias(GrupoTableMap::COL_IDGRUPO, $grupo->getIdgrupo(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Grupo table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GrupoTableMap::clearInstancePool();
            GrupoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GrupoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            GrupoTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            GrupoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GrupoQuery
