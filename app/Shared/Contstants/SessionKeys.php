<?php
declare(strict_types= 1);
namespace App\Shared\Contstants;

final class SessionKeys {
    //for owners features  
    public const OWNER_EDIT_PREVIOUS_PAGE = 'owner_edit_last_page';
    public const OWNER_CURRENT_INDEX_PAGE = 'owner_current_index_page';
    // ----------------------
    //for renter features  
    public const RENTER_EDIT_PREVIOUS_PAGE = 'renter_edit_last_page';
    public const RENTER_CURRENT_INDEX_PAGE = 'renter_current_index_page';
    // ----------------------
}