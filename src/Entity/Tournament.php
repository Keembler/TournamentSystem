<?php

namespace App\Entity;

use App\Repository\TournamentRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Slug;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
class Tournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var string|null
     *
     * @Gedmo\Mapping\Annotation\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, nullable=false, unique=true)
     */
    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(nullable: true)]
    private ?array $matches = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getMatches(): ?array
    {
        return $this->matches;
    }

    public function setMatches(?array $matches): static
    {
        $this->matches = $this->generateMatches($matches);

        return $this;
    }

    /**
     * Генерация сетки турнира
     *
     * @param array|null $teams
     * @return array|null
     */
    public function generateMatches(?array $teams): ?array
    {
        if (count($teams) % 2 == 1)
            array_push($teams, 'none');

        $matches = array();
        $num_teams = count($teams);

        for ($day = 0; $day < $num_teams - 1; $day++) {
            for ($i = 0; $i < $num_teams / 2; $i++) {
                $matches[] = array($teams[$i], $teams[$num_teams - 1 - $i]);
            }

            array_splice($teams, 1, 0, array_pop($teams));
        }

        return $matches;
    }

    /**
     * Формирование HTML сетки турнира
     *
     * @return string
     */
    public function getScheduleMatches(): string
    {
        $html = '';
        $matches = $this->getMatches();

        switch (count($matches)) {
            case 6:
                $count = 2;
                break;
            case 15:
                $count = 3;
                break;
            default:
                $count = 4;
        }

        foreach (array_chunk($matches, $count, true) as $day => $daily_matches) {
            $html .= "<br>Day " . ($day + 1) . ":<br>";

            foreach ($daily_matches as $match) {
                if ($match[0] == 'none' || $match[1] == 'none') continue;
                $html .= $match[0] . " vs " . $match[1] . "<br>";
            }
        }

        return $html;
    }
}
