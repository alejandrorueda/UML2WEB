<?php

namespace Base;

use \Mensajes as ChildMensajes;
use \MensajesQuery as ChildMensajesQuery;
use \Exception;
use \PDO;
use Map\MensajesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Mensajes' table.
 *
 * 
 *
 * @method     ChildMensajesQuery orderByIdmensajes($order = Criteria::ASC) Order by the idMensajes column
 * @method     ChildMensajesQuery orderByAsunto($order = Criteria::ASC) Order by the asunto column
 * @method     ChildMensajesQuery orderByDescripcion($order = Criteria::ASC) Order by the descripcion column
 * @method     ChildMensajesQuery orderByFkviaje($order = Criteria::ASC) Order by the fkviaje column
 * @method     ChildMensajesQuery orderByFkpadre($order = Criteria::ASC) Order by the fkpadre column
 *
 * @method     ChildMensajesQuery groupByIdmensajes() Group by the idMensajes column
 * @method     ChildMensajesQuery groupByAsunto() Group by the asunto column
 * @method     ChildMensajesQuery groupByDescripcion() Group by the descripcion column
 * @method     ChildMensajesQuery groupByFkviaje() Group by the fkviaje column
 * @method     ChildMensajesQuery groupByFkpadre() Group by the fkpadre column
 *
 * @method     ChildMensajesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMensajesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMensajesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMensajesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMensajesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMensajesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMensajesQuery leftJoinViaje($relationAlias = null) Adds a LEFT JOIN clause to the query using the Viaje relation
 * @method     ChildMensajesQuery rightJoinViaje($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Viaje relation
 * @method     ChildMensajesQuery innerJoinViaje($relationAlias = null) Adds a INNER JOIN clause to the query using the Viaje relation
 *
 * @method     ChildMensajesQuery joinWithViaje($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Viaje relation
 *
 * @method     ChildMensajesQuery leftJoinWithViaje() Adds a LEFT JOIN clause and with to the query using the Viaje relation
 * @method     ChildMensajesQuery rightJoinWithViaje() Adds a RIGHT JOIN clause and with to the query using the Viaje relation
 * @method     ChildMensajesQuery innerJoinWithViaje() Adds a INNER JOIN clause and with to the query using the Viaje relation
 *
 * @method     ChildMensajesQuery leftJoinMensajesRelatedByFkpadre($relationAlias = null) Adds a LEFT JOIN clause to the query using the MensajesRelatedByFkpadre relation
 * @method     ChildMensajesQuery rightJoinMensajesRelatedByFkpadre($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MensajesRelatedByFkpadre relation
 * @method     ChildMensajesQuery innerJoinMensajesRelatedByFkpadre($relationAlias = null) Adds a INNER JOIN clause to the query using the MensajesRelatedByFkpadre relation
 *
 * @method     ChildMensajesQuery joinWithMensajesRelatedByFkpadre($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MensajesRelatedByFkpadre relation
 *
 * @method     ChildMensajesQuery leftJoinWithMensajesRelatedByFkpadre() Adds a LEFT JOIN clause and with to the query using the MensajesRelatedByFkpadre relation
 * @method     ChildMensajesQuery rightJoinWithMensajesRelatedByFkpadre() Adds a RIGHT JOIN clause and with to the query using the MensajesRelatedByFkpadre relation
 * @method     ChildMensajesQuery innerJoinWithMensajesRelatedByFkpadre() Adds a INNER JOIN clause and with to the query using the MensajesRelatedByFkpadre relation
 *
 * @method     ChildMensajesQuery leftJoinMensajesRelatedByIdmensajes($relationAlias = null) Adds a LEFT JOIN clause to the query using the MensajesRelatedByIdmensajes relation
 * @method     ChildMensajesQuery rightJoinMensajesRelatedByIdmensajes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MensajesRelatedByIdmensajes relation
 * @method     ChildMensajesQuery innerJoinMensajesRelatedByIdmensajes($relationAlias = null) Adds a INNER JOIN clause to the query using the MensajesRelatedByIdmensajes relation
 *
 * @method     ChildMensajesQuery joinWithMensajesRelatedByIdmensajes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MensajesRelatedByIdmensajes relation
 *
 * @method     ChildMensajesQuery leftJoinWithMensajesRelatedByIdmensajes() Adds a LEFT JOIN clause and with to the query using the MensajesRelatedByIdmensajes relation
 * @method     ChildMensajesQuery rightJoinWithMensajesRelatedByIdmensajes() Adds a RIGHT JOIN clause and with to the query using the MensajesRelatedByIdmensajes relation
 * @method     ChildMensajesQuery innerJoinWithMensajesRelatedByIdmensajes() Adds a INNER JOIN clause and with to the query using the MensajesRelatedByIdmensajes relation
 *
 * @method     \ViajeQuery|\MensajesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMensajes findOne(ConnectionInterface $con = null) Return the first ChildMensajes matching the query
 * @method     ChildMensajes findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMensajes matching the query, or a new ChildMensajes object populated from the query conditions when no match is found
 *
 * @method     ChildMensajes findOneByIdmensajes(int $idMensajes) Return the first ChildMensajes filtered by the idMensajes column
 * @method     ChildMensajes findOneByAsunto(string $asunto) Return the first ChildMensajes filtered by the asunto column
 * @method     ChildMensajes findOneByDescripcion(string $descripcion) Return the first ChildMensajes filtered by the descripcion column
 * @method     ChildMensajes findOneByFkviaje(int $fkviaje) Return the first ChildMensajes filtered by the fkviaje column
 * @method     ChildMensajes findOneByFkpadre(int $fkpadre) Return the first ChildMensajes filtered by the fkpadre column *

 * @method     ChildMensajes requirePk($key, ConnectionInterface $con = null) Return the ChildMensajes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMensajes requireOne(ConnectionInterface $con = null) Return the first ChildMensajes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMensajes requireOneByIdmensajes(int $idMensajes) Return the first ChildMensajes filtered by the idMensajes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMensajes requireOneByAsunto(string $asunto) Return the first ChildMensajes filtered by the asunto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMensajes requireOneByDescripcion(string $descripcion) Return the first ChildMensajes filtered by the descripcion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMensajes requireOneByFkviaje(int $fkviaje) Return the first ChildMensajes filtered by the fkviaje column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMensajes requireOneByFkpadre(int $fkpadre) Return the first ChildMensajes filtered by the fkpadre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMensajes[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMensajes objects based on current ModelCriteria
 * @method     ChildMensajes[]|ObjectCollection findByIdmensajes(int $idMensajes) Return ChildMensajes objects filtered by the idMensajes column
 * @method     ChildMensajes[]|ObjectCollection findByAsunto(string $asunto) Return ChildMensajes objects filtered by the asunto column
 * @method     ChildMensajes[]|ObjectCollection findByDescripcion(string $descripcion) Return ChildMensajes objects filtered by the descripcion column
 * @method     ChildMensajes[]|ObjectCollection findByFkviaje(int $fkviaje) Return ChildMensajes objects filtered by the fkviaje column
 * @method     ChildMensajes[]|ObjectCollection findByFkpadre(int $fkpadre) Return ChildMensajes objects filtered by the fkpadre column
 * @method     ChildMensajes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MensajesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\MensajesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'prueba', $modelName = '\\Mensajes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMensajesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMensajesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMensajesQuery) {
            return $criteria;
        }
        $query = new ChildMensajesQuery();
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
     * @return ChildMensajes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MensajesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MensajesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMensajes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idMensajes, asunto, descripcion, fkviaje, fkpadre FROM Mensajes WHERE idMensajes = :p0';
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
            /** @var ChildMensajes $obj */
            $obj = new ChildMensajes();
            $obj->hydrate($row);
            MensajesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMensajes|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMensajesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MensajesTableMap::COL_IDMENSAJES, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMensajesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MensajesTableMap::COL_IDMENSAJES, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idMensajes column
     *
     * Example usage:
     * <code>
     * $query->filterByIdmensajes(1234); // WHERE idMensajes = 1234
     * $query->filterByIdmensajes(array(12, 34)); // WHERE idMensajes IN (12, 34)
     * $query->filterByIdmensajes(array('min' => 12)); // WHERE idMensajes > 12
     * </code>
     *
     * @param     mixed $idmensajes The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMensajesQuery The current query, for fluid interface
     */
    public function filterByIdmensajes($idmensajes = null, $comparison = null)
    {
        if (is_array($idmensajes)) {
            $useMinMax = false;
            if (isset($idmensajes['min'])) {
                $this->addUsingAlias(MensajesTableMap::COL_IDMENSAJES, $idmensajes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idmensajes['max'])) {
                $this->addUsingAlias(MensajesTableMap::COL_IDMENSAJES, $idmensajes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MensajesTableMap::COL_IDMENSAJES, $idmensajes, $comparison);
    }

    /**
     * Filter the query on the asunto column
     *
     * Example usage:
     * <code>
     * $query->filterByAsunto('fooValue');   // WHERE asunto = 'fooValue'
     * $query->filterByAsunto('%fooValue%'); // WHERE asunto LIKE '%fooValue%'
     * </code>
     *
     * @param     string $asunto The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMensajesQuery The current query, for fluid interface
     */
    public function filterByAsunto($asunto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($asunto)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MensajesTableMap::COL_ASUNTO, $asunto, $comparison);
    }

    /**
     * Filter the query on the descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByDescripcion('fooValue');   // WHERE descripcion = 'fooValue'
     * $query->filterByDescripcion('%fooValue%'); // WHERE descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descripcion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMensajesQuery The current query, for fluid interface
     */
    public function filterByDescripcion($descripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MensajesTableMap::COL_DESCRIPCION, $descripcion, $comparison);
    }

    /**
     * Filter the query on the fkviaje column
     *
     * Example usage:
     * <code>
     * $query->filterByFkviaje(1234); // WHERE fkviaje = 1234
     * $query->filterByFkviaje(array(12, 34)); // WHERE fkviaje IN (12, 34)
     * $query->filterByFkviaje(array('min' => 12)); // WHERE fkviaje > 12
     * </code>
     *
     * @see       filterByViaje()
     *
     * @param     mixed $fkviaje The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMensajesQuery The current query, for fluid interface
     */
    public function filterByFkviaje($fkviaje = null, $comparison = null)
    {
        if (is_array($fkviaje)) {
            $useMinMax = false;
            if (isset($fkviaje['min'])) {
                $this->addUsingAlias(MensajesTableMap::COL_FKVIAJE, $fkviaje['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkviaje['max'])) {
                $this->addUsingAlias(MensajesTableMap::COL_FKVIAJE, $fkviaje['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MensajesTableMap::COL_FKVIAJE, $fkviaje, $comparison);
    }

    /**
     * Filter the query on the fkpadre column
     *
     * Example usage:
     * <code>
     * $query->filterByFkpadre(1234); // WHERE fkpadre = 1234
     * $query->filterByFkpadre(array(12, 34)); // WHERE fkpadre IN (12, 34)
     * $query->filterByFkpadre(array('min' => 12)); // WHERE fkpadre > 12
     * </code>
     *
     * @see       filterByMensajesRelatedByFkpadre()
     *
     * @param     mixed $fkpadre The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMensajesQuery The current query, for fluid interface
     */
    public function filterByFkpadre($fkpadre = null, $comparison = null)
    {
        if (is_array($fkpadre)) {
            $useMinMax = false;
            if (isset($fkpadre['min'])) {
                $this->addUsingAlias(MensajesTableMap::COL_FKPADRE, $fkpadre['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkpadre['max'])) {
                $this->addUsingAlias(MensajesTableMap::COL_FKPADRE, $fkpadre['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MensajesTableMap::COL_FKPADRE, $fkpadre, $comparison);
    }

    /**
     * Filter the query by a related \Viaje object
     *
     * @param \Viaje|ObjectCollection $viaje The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMensajesQuery The current query, for fluid interface
     */
    public function filterByViaje($viaje, $comparison = null)
    {
        if ($viaje instanceof \Viaje) {
            return $this
                ->addUsingAlias(MensajesTableMap::COL_FKVIAJE, $viaje->getIdviaje(), $comparison);
        } elseif ($viaje instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MensajesTableMap::COL_FKVIAJE, $viaje->toKeyValue('PrimaryKey', 'Idviaje'), $comparison);
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
     * @return $this|ChildMensajesQuery The current query, for fluid interface
     */
    public function joinViaje($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useViajeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinViaje($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Viaje', '\ViajeQuery');
    }

    /**
     * Filter the query by a related \Mensajes object
     *
     * @param \Mensajes|ObjectCollection $mensajes The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMensajesQuery The current query, for fluid interface
     */
    public function filterByMensajesRelatedByFkpadre($mensajes, $comparison = null)
    {
        if ($mensajes instanceof \Mensajes) {
            return $this
                ->addUsingAlias(MensajesTableMap::COL_FKPADRE, $mensajes->getIdmensajes(), $comparison);
        } elseif ($mensajes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MensajesTableMap::COL_FKPADRE, $mensajes->toKeyValue('PrimaryKey', 'Idmensajes'), $comparison);
        } else {
            throw new PropelException('filterByMensajesRelatedByFkpadre() only accepts arguments of type \Mensajes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MensajesRelatedByFkpadre relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMensajesQuery The current query, for fluid interface
     */
    public function joinMensajesRelatedByFkpadre($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MensajesRelatedByFkpadre');

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
            $this->addJoinObject($join, 'MensajesRelatedByFkpadre');
        }

        return $this;
    }

    /**
     * Use the MensajesRelatedByFkpadre relation Mensajes object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MensajesQuery A secondary query class using the current class as primary query
     */
    public function useMensajesRelatedByFkpadreQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMensajesRelatedByFkpadre($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MensajesRelatedByFkpadre', '\MensajesQuery');
    }

    /**
     * Filter the query by a related \Mensajes object
     *
     * @param \Mensajes|ObjectCollection $mensajes the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMensajesQuery The current query, for fluid interface
     */
    public function filterByMensajesRelatedByIdmensajes($mensajes, $comparison = null)
    {
        if ($mensajes instanceof \Mensajes) {
            return $this
                ->addUsingAlias(MensajesTableMap::COL_IDMENSAJES, $mensajes->getFkpadre(), $comparison);
        } elseif ($mensajes instanceof ObjectCollection) {
            return $this
                ->useMensajesRelatedByIdmensajesQuery()
                ->filterByPrimaryKeys($mensajes->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMensajesRelatedByIdmensajes() only accepts arguments of type \Mensajes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MensajesRelatedByIdmensajes relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMensajesQuery The current query, for fluid interface
     */
    public function joinMensajesRelatedByIdmensajes($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MensajesRelatedByIdmensajes');

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
            $this->addJoinObject($join, 'MensajesRelatedByIdmensajes');
        }

        return $this;
    }

    /**
     * Use the MensajesRelatedByIdmensajes relation Mensajes object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MensajesQuery A secondary query class using the current class as primary query
     */
    public function useMensajesRelatedByIdmensajesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMensajesRelatedByIdmensajes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MensajesRelatedByIdmensajes', '\MensajesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMensajes $mensajes Object to remove from the list of results
     *
     * @return $this|ChildMensajesQuery The current query, for fluid interface
     */
    public function prune($mensajes = null)
    {
        if ($mensajes) {
            $this->addUsingAlias(MensajesTableMap::COL_IDMENSAJES, $mensajes->getIdmensajes(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Mensajes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MensajesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MensajesTableMap::clearInstancePool();
            MensajesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MensajesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MensajesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            MensajesTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            MensajesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MensajesQuery
