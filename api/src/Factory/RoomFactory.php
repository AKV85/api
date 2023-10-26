<?php

namespace App\Factory;

use App\Entity\Room;
use App\Repository\RoomRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Room>
 *
 * @method        Room|Proxy                     create(array|callable $attributes = [])
 * @method static Room|Proxy                     createOne(array $attributes = [])
 * @method static Room|Proxy                     find(object|array|mixed $criteria)
 * @method static Room|Proxy                     findOrCreate(array $attributes)
 * @method static Room|Proxy                     first(string $sortedField = 'id')
 * @method static Room|Proxy                     last(string $sortedField = 'id')
 * @method static Room|Proxy                     random(array $attributes = [])
 * @method static Room|Proxy                     randomOrCreate(array $attributes = [])
 * @method static RoomRepository|RepositoryProxy repository()
 * @method static Room[]|Proxy[]                 all()
 * @method static Room[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Room[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Room[]|Proxy[]                 findBy(array $attributes)
 * @method static Room[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Room[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class RoomFactory extends ModelFactory
{
    private const STATUSES_NAMES = ['readyToUse', 'needsCleaning', 'partlyFree', 'rent'];
    private const ROOM_HOTEL_NAMES = ['DebrecenoHotel', 'NearAkropolis', 'CityCenter'];
    private const ROOM_NUMBERS = ['1A', '2A', '3A', '4A', '1B', '2B', '3B', '4B','5','6','7','8','9','10','11','12','13','14','15'];

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'freeBed' => self::faker()->randomNumber(range(0,3,1)),
            'roomHotelName' => self::faker()->randomElement(self::ROOM_HOTEL_NAMES),
            'roomNumber' => self::faker()->randomElement(self::ROOM_NUMBERS),
            'status' => self::faker()->randomElement(self::STATUSES_NAMES),
            'totalbeds' => self::faker()->randomNumber(range(2,4,1)),
            'updatedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Room $room): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Room::class;
    }
}
