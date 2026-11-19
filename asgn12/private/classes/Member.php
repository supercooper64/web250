<?php

declare(strict_types=1);

final class Member
{
    private static ?PDO $database = null;

    public int $id = 0;
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $username = '';
    public string $password_hash = '';
    public string $role = 'member';

    public static function set_database(PDO $pdo): void
    {
        self::$database = $pdo;
    }

    public static function find_by_username(string $username): ?self
    {
        if (self::$database === null) {
            throw new RuntimeException(
                'Call set_database() before find_by_username().'
            );
        }

        $sql = '
            SELECT *
            FROM members
            WHERE username = :username
            LIMIT 1
        ';

        $statement = self::$database->prepare($sql);

        $statement->bindValue(
            ':username',
            $username,
            PDO::PARAM_STR
        );

        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        return self::from_row($row);
    }

    public static function find_by_email(string $email): ?self
    {
        if (self::$database === null) {
            throw new RuntimeException(
                'Call set_database() before find_by_email().'
            );
        }

        $sql = '
            SELECT *
            FROM members
            WHERE email = :email
            LIMIT 1
        ';

        $statement = self::$database->prepare($sql);

        $statement->bindValue(
            ':email',
            $email,
            PDO::PARAM_STR
        );

        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        return self::from_row($row);
    }

    public function create(): bool
    {
        if (self::$database === null) {
            throw new RuntimeException(
                'Call set_database() before create().'
            );
        }

        $sql = '
            INSERT INTO members (
                first_name,
                last_name,
                email,
                username,
                password_hash,
                role
            ) VALUES (
                :first_name,
                :last_name,
                :email,
                :username,
                :password_hash,
                :role
            )
        ';

        $statement = self::$database->prepare($sql);

        $statement->bindValue(
            ':first_name',
            $this->first_name,
            PDO::PARAM_STR
        );

        $statement->bindValue(
            ':last_name',
            $this->last_name,
            PDO::PARAM_STR
        );

        $statement->bindValue(
            ':email',
            $this->email,
            PDO::PARAM_STR
        );

        $statement->bindValue(
            ':username',
            $this->username,
            PDO::PARAM_STR
        );

        $statement->bindValue(
            ':password_hash',
            $this->password_hash,
            PDO::PARAM_STR
        );

        $statement->bindValue(
            ':role',
            $this->role,
            PDO::PARAM_STR
        );

        $result = $statement->execute();

        if ($result) {
            $this->id = (int) self::$database->lastInsertId();
        }

        return $result;
    }

    private static function from_row(array $row): self
    {
        $member = new self();

        $member->id = (int) $row['id'];
        $member->first_name = (string) $row['first_name'];
        $member->last_name = (string) $row['last_name'];
        $member->email = (string) $row['email'];
        $member->username = (string) $row['username'];
        $member->password_hash = (string) $row['password_hash'];
        $member->role = (string) $row['role'];

        return $member;
    }
}