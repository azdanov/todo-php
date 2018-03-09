<?php

declare(strict_types=1);

namespace Todo\Storage\Contract;

use Todo\Models\Task;

/**
 * Interface TaskStorageInterface.
 */
interface TaskStorageInterface
{
    /**
     * @param Task $task
     *
     * @return Task
     */
    public function store(Task $task): Task;

    /**
     * @param Task $task
     *
     * @return Task
     */
    public function update(Task $task): Task;

    /**
     * @param int $id
     *
     * @return Task
     */
    public function get(int $id): Task;

    /**
     * @param Task $task
     *
     * @return Task
     */
    public function delete(Task $task): Task;

    /**
     * @return Task[]
     */
    public function all(): array;
}
