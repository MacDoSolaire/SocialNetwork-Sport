<?php

namespace App\Factory;

use App\Entity\Membre;
use App\Repository\MembreRepository;
use Jdenticon\Identicon;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Membre|Proxy createOne(array $attributes = [])
 * @method static Membre[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Membre|Proxy findOrCreate(array $attributes)
 * @method static Membre|Proxy random(array $attributes = [])
 * @method static Membre|Proxy randomOrCreate(array $attributes = [])
 * @method static Membre[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Membre[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static MembreRepository|RepositoryProxy repository()
 * @method Membre|Proxy create($attributes = [])
 */
final class MembreFactory extends ModelFactory
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct();

        $this->passwordEncoder = $passwordEncoder;
        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        $firstName = self::faker()->firstName;
        $lastName = self::faker()->lastName;
        return [
            'mail' => self::faker()->unique()->email,
            'roles' => array(),
            'password' => "test",
            'nom' => $firstName,
            'prenom' => $lastName,
            'ville' => 'Reims',
            'cdPost' => 51100,
            'avatar' => self::createAvatar($firstName.$lastName)
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            ->afterInstantiate(function(Membre $user) {
                $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
            })
            ;
    }

    protected static function getClass(): string
    {
        return Membre::class;
    }

    protected static function createAvatar(string $value)
    {
        $icon = new Identicon();
        $icon->setValue($value);
        $icon->setSize(50);
        return fopen($icon->getImageDataUri('png'),'r');
    }
}