<?php 

class UserController { // to be implemented

    public static function getAllUsers(): array {}

    public static function getUserById(string $userId): array {}

    public static function getUserBalanceByUserId(string $userId): array {}

    public static function updateUserTransactionTable(array $userData): array {}

    public static function updateUserBalance(string $userId, string $recharge_amount): array {}

    public static function deleteUser(string $userId): bool {}

}