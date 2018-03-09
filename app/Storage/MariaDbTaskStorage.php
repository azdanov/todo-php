<?php

declare(strict_types=1);

namespace Todo\Storage;

use PDO;
use Todo\Models\Task;
use Todo\Storage\Contract\TaskStorageInterface;
use function array_merge;

/**
 * Class MariaDbTaskStorage.
 */
class MariaDbTaskStorage implements TaskStorageInterface
{
    private $db;

    /**
     * MariaDbTaskStorage constructor.
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @param Task $task
     *
     * @return Task
     */
    public function store(Task $task): Task
    {
        $sql = 'INSERT INTO `tasks` (`description`, `due`, `complete`) VALUES (:description, :due, :complete)';

        $this->db
            ->prepare($sql)
            ->execute(
                $this->buildColumns($task)
            );

        return $this->get((int) $this->db->lastInsertId());
    }

    /**
     * @param int $id
     *
     * @return Task
     */
    public function get(int $id): Task
    {
        $sql = 'SELECT `id`, `description`, `due`, `complete` FROM `tasks` WHERE `id`=:id';
        $statement = $this->db
            ->prepare($sql);

        $statement->setFetchMode(PDO::FETCH_CLASS, Task::class);

        $statement->execute(
            [
                'id' => $id,
            ]
        );

        return $statement->fetch();
    }

    /**
     * @param Task $task
     *
     * @return Task
     */
    public function update(Task $task): Task
    {
        $sql = 'UPDATE `tasks` SET `description`=:description, `due`=:due, `complete`=:complete WHERE `id`=:id';

        $this->db
            ->prepare($sql)
            ->execute(
                $this->buildColumns($task, ['id' => $task->getId()])
            );

        return $this->get($task->getId());
    }

    /**
     * @return Task[]
     */
    public function all(): array
    {
        $sql = 'SELECT * FROM `tasks`';
        $statement = $this->db->query($sql);

        $statement->setFetchMode(PDO::FETCH_CLASS, Task::class);

        return $statement->fetchAll();
    }

    /**
     * @param Task $task
     *
     * @return Task
     */
    public function delete(Task $task): Task
    {
        $this->db->prepare('DELETE FROM `tasks` WHERE `id`=:id')
            ->execute(
                [
                    'id' => $task->getId(),
                ]
            );

        return $task;
    }

    /**
     * @param Task  $task
     * @param array $additional
     *
     * @return array
     */
    protected function buildColumns(Task $task, array $additional = null): array
    {
        return array_merge(
            [
                'description' => $task->getDescription(),
                'due' => $task->getDue()->format('Y-m-d H:i:s'),
                'complete' => $task->isComplete() ? 1 : 0,
            ],
            $additional
        );
    }
}
