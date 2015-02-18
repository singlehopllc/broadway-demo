<?php
/**
 * User: mhightower
 * Date: 2/3/15
 */

namespace BroadwayDemo\User;

use Broadway\CommandHandling\Testing\CommandHandlerScenarioTestCase;
use Broadway\EventHandling\EventBusInterface;
use Broadway\EventStore\EventStoreInterface;

abstract class UserCommandHandlerTest extends CommandHandlerScenarioTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function createCommandHandler(EventStoreInterface $eventStore, EventBusInterface $eventBus)
    {
        return new \BroadwayDemo\User\UserCommandHandler(
            new UserRepository($eventStore, $eventBus)
        );
    }
}
