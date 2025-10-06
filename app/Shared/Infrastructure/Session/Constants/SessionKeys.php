<?php
declare(strict_types= 1);
namespace App\Shared\Infrastructure\Session\Constants;
 

final class SessionKeys {
    //for owners features  
    public const OWNER_EDIT_PREVIOUS_PAGE = 'owner_edit_last_page';
    public const OWNER_CURRENT_INDEX_PAGE = 'owner_current_index_page';
    // ----------------------
    //for renter features  
    public const RENTER_EDIT_PREVIOUS_PAGE = 'renter_edit_last_page';
    public const RENTER_CURRENT_INDEX_PAGE = 'renter_current_index_page';
    // ----------------------

    //for unit features  
    public const UNIT_EDIT_PREVIOUS_PAGE = 'unit_edit_last_page';
    public const UNIT_CURRENT_INDEX_PAGE = 'unit_current_index_page';
    // ----------------------

    //for estate document features  
    public const ESTATE_DOCUMENT_EDIT_PREVIOUS_PAGE = 'estate_document_edit_last_page';
    public const ESTATE_DOCUMENT_CURRENT_INDEX_PAGE = 'estate_document_current_index_page';
    // ----------------------
}