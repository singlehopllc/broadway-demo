<?php
/**
 * User: mhightower
 * Date: 2/2/15
 */

namespace BroadwayDemo\User;

use Broadway\EventHandling\EventBusInterface;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStoreInterface;
use Broadway\Repository\RepositoryInterface;

class UserRepository extends EventSourcingRepository
{
    public function __construct(
        EventStoreInterface $eventStore,
        EventBusInterface $eventBus,
        array $eventStreamDecorators = array()
    ) {
        parent::__construct(
            $eventStore,
            $eventBus,
            '\BroadwayDemo\User\User',
            new PublicConstructorAggregateFactory(),
            $eventStreamDecorators
        );
    }
}
