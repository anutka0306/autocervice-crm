<?php
namespace App\Enums;

enum BookingStatuses: string
{
    case New = 'new';
    case InProgress = 'in_progress';
    case Late = 'late';

    public function label(): string
{
    return match($this) {
        self::New => 'Авто в записи',
        self::InProgress => 'Авто в работе',
        self::Late => 'Авто опаздывает по записи',
    };
}

    public function color(): string
{
    return match($this) {
        self::New => 'background-color: #facc15; color: #713f12;',

        self::InProgress => 'background-color: #4ade80; color: #14532d;',

        self::Late => 'background-color: #f87171; color: #7f1d1d;',

    };
}

    public function bgColor(): string
{
    return match($this) {
        self::New => 'bg-yellow-300 text-yellow-900 border border-yellow-400',

        self::InProgress => 'bg-green-300 text-green-900 border border-green-400',

        self::Late => 'bg-red-300 text-red-900 border border-red-400',
    };
}

}
