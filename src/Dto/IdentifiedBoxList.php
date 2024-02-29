<?php

declare(strict_types = 1);

namespace App\Dto;

class IdentifiedBoxList
{

    private array $boxes;

    public function __construct(IdentifiedBox ...$boxes)
    {
        $this->boxes = $boxes;
    }

    /**
     * @return Box[]
     */
    public function getBoxes(): array
    {
        return $this->boxes;
    }

    public function sortByVolume(): self
    {
        $boxes = $this->boxes;

        usort($boxes, function (Box $a, Box $b) {
            return $a->getVolume() <=> $b->getVolume();
        });

        return new self(...$boxes);
    }

    public function getDeterministicIdentifier(): string
    {
        $scalarParams = [];

        // @todo sorting by volumes might not be deterministic... add tests and check. Might be problem for packages with same volume items
        foreach ($this->sortByVolume()->getBoxes() as $box) {
            $scalarParams[] = $box->getSideLengthsAscending();
        }

        return md5(serialize($scalarParams));
    }

}
