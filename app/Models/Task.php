<?php

declare(strict_types=1);

namespace Todo\Models;

use DateTime;

/**
 * Class Task.
 */
class Task
{
    protected $id;
    protected $complete = false;
    protected $description;
    protected $due;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Task
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return bool
     */
    public function isComplete(): bool
    {
        return (bool) $this->complete;
    }

    /**
     * @param bool $complete
     *
     * @return Task
     */
    public function setComplete(bool $complete = null): self
    {
        $this->complete = $complete ?? true;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Task
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDue(): DateTime
    {
        return $this->due instanceof DateTime
            ? $this->due
            : new DateTime($this->due);
    }

    /**
     * @param DateTime $due
     *
     * @return Task
     */
    public function setDue(DateTime $due): self
    {
        $this->due = $due;

        return $this;
    }
}
