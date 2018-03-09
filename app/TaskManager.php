<?php

declare(strict_types=1);

namespace Todo;

use Todo\Models\Task;
use Todo\Storage\Contract\TaskStorageInterface;

/**
 * Class TaskManager.
 */
class TaskManager
{
    /**
     * @var TaskStorageInterface
     */
    protected $storage;

    /**
     * TaskManager constructor.
     *
     * @param TaskStorageInterface $storage
     */
    public function __construct(TaskStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param Task $task
     *
     * @return Task
     */
    public function addTask(Task $task): Task
    {
        return $this->storage->store($task);
    }

    /**
     * @param Task $task
     *
     * @return Task
     */
    public function deleteTask(Task $task): Task
    {
        return $this->storage->delete($task);
    }

    /**
     * @param Task $task
     *
     * @return Task
     */
    public function updateTask(Task $task): Task
    {
        return $this->storage->update($task);
    }

    /**
     * @param int $id
     *
     * @return Task
     */
    public function getTask(int $id): Task
    {
        return $this->storage->get($id);
    }

    /**
     * @return Task[]
     */
    public function getTasks(): array
    {
        return $this->storage->all();
    }
}
