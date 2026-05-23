<?php
namespace App\Enums;

enum BookingStatuses: string
{
    case New = 'new';
    case InProgress = 'in_progress';
    case Done = 'done';

    public function label(): string
{
    return match($this) {
        self::New => 'Новая',
        self::InProgress => 'В процессе',
        self::Done => 'Готова',
    };
}

    public function color(): string
{
    return match($this) {
        self::New => 'background-color: #f1f5f9; color: #475569;',
        self::InProgress => 'background-color: #fef3c7; color: #b45309;',
        self::Done => 'background-color: #dcfce7; color: #166534;',
    };
}

    public function bgColor(): string
{
    return match($this) {
        self::New => 'bg-gray-200 text-gray-800',
        self::InProgress => 'bg-orange-200 text-orange-800',
        self::Done => 'bg-green-200 text-green-800',
    };
}

}
