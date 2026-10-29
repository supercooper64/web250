<?php

declare(strict_types=1);

final class Bird
{
    private static ?PDO $database = null;

    public int $id = 0;
    public string $common_name = '';
    public string $scientific_name = '';
    public string $family_name = '';
    public string $primary_habitat = '';
    public string $seasonal_status = '';
    public string $description = '';

    public static function set_database(PDO $pdo): void
    {
        self::$database = $pdo;
    }

    /** @return Bird[] */
    public static function find_all(): array
    {
        if (self::$database === null) {
            throw new RuntimeException('Call set_database() before find_all().');
        }

        $sql = 'SELECT id, common_name, scientific_name, family_name,
                       primary_habitat, seasonal_status, description
                FROM birds
                ORDER BY common_name';

        $statement = self::$database->query($sql);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $birds = [];
        foreach ($rows as $row) {
            $birds[] = self::from_row($row);
        }

        return $birds;
    }

    public static function find_by_id(int $id): ?self
    {
        if (self::$database === null) {
            throw new RuntimeException('Call set_database() before find_by_id().');
        }

        $sql = 'SELECT id, common_name, scientific_name, family_name,
                       primary_habitat, seasonal_status, description
                FROM birds
                WHERE id = :id
                LIMIT 1';

        $statement = self::$database->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        return self::from_row($row);
    }

    public static function count_all(): int
    {
        if (self::$database === null) {
            throw new RuntimeException('Call set_database() before count_all().');
        }

        $statement = self::$database->query('SELECT COUNT(*) FROM birds');
        return (int) $statement->fetchColumn();
    }

    private static function from_row(array $row): self
    {
        $bird = new self();
        $bird->id = (int) $row['id'];
        $bird->common_name = (string) $row['common_name'];
        $bird->scientific_name = (string) $row['scientific_name'];
        $bird->family_name = (string) $row['family_name'];
        $bird->primary_habitat = (string) $row['primary_habitat'];
        $bird->seasonal_status = (string) $row['seasonal_status'];
        $bird->description = (string) $row['description'];

        return $bird;
    }

    // asgn09 TODO:
    // Add public function create(): bool here.
    // Follow the assignment tutorial carefully:
    // 1. Check self::$database.
    // 2. Build INSERT INTO birds (...) VALUES (:placeholders...).
    // 3. prepare($sql).
    // 4. bindValue() each Bird property.
    // 5. execute().
    // 6. On success, assign lastInsertId() to $this->id.
    // 7. Return the result.
    public function create(): bool
{
    if (self::$database === null) {
        throw new RuntimeException(
            'Call set_database() before create().'
        );
    }

    $sql = 'INSERT INTO birds (
                common_name,
                scientific_name,
                family_name,
                primary_habitat,
                seasonal_status,
                description
            ) VALUES (
                :common_name,
                :scientific_name,
                :family_name,
                :primary_habitat,
                :seasonal_status,
                :description
            )';

    $statement = self::$database->prepare($sql);

    $statement->bindValue(
        ':common_name',
        $this->common_name,
        PDO::PARAM_STR
    );

    $statement->bindValue(
        ':scientific_name',
        $this->scientific_name,
        PDO::PARAM_STR
    );

    $statement->bindValue(
        ':family_name',
        $this->family_name,
        PDO::PARAM_STR
    );

    $statement->bindValue(
        ':primary_habitat',
        $this->primary_habitat,
        PDO::PARAM_STR
    );

    $statement->bindValue(
        ':seasonal_status',
        $this->seasonal_status,
        PDO::PARAM_STR
    );

    $statement->bindValue(
        ':description',
        $this->description,
        PDO::PARAM_STR
    );

    $result = $statement->execute();

    if ($result) {
        $this->id = (int) self::$database->lastInsertId();
    }

    return $result;
}
}
