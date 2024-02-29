<?php

declare(strict_types = 1);

namespace App\Api\BinPacking\Request;

use App\Dto\IdentifiedBox;
use App\Dto\IdentifiedBoxList;
use App\Entity\Packaging;
use App\List\PackagingList;

class BinPackingRequestFactory
{

    private const QUANTITY = 1;

    public function createFindBoxSizeRequest(
        PackagingList $availablePackagings,
        IdentifiedBoxList $identifiedBoxes,
    ): FindBoxSizeRequest
    {
        return new FindBoxSizeRequest(
            array_map(
                function (Packaging $packaging): FindBoxSizeBin {
                    return new FindBoxSizeBin(
                        $packaging->getId(),
                        $packaging->getWidth(),
                        $packaging->getHeight(),
                        $packaging->getLength()
                    );
                },
                $availablePackagings->getPackagings()
            ),
            array_map(
                function (IdentifiedBox $box): FindBoxSizeItem {
                    return new FindBoxSizeItem(
                        (string) $box->getId(),
                        $box->getWidth(),
                        $box->getHeight(),
                        $box->getLength(),
                        self::QUANTITY
                    );
                },
                $identifiedBoxes->getBoxes()
            )
        );
    }

}
