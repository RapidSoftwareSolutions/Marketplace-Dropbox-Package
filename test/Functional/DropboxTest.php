<?php

namespace Test\Functional;

require_once(__DIR__ . '/../../src/Models/checkRequest.php');
class MapillaryTest extends BaseTestCase {

    public function testListMetrics() {

        $routes = [
            'updateFolderPolicy',
            'updateFolderMemberAccess',
            'updateFileMemberAccess',
            'transferFolderOwnership',
            'checkRemoveMemberStatus',
            'removeFolderMember',
            'removeFileMember',
            'revokeSharedLink',
            'unmountFolder',
            'mountFolder',
            'unshareFile',
            'unshareFolder',
            'shareFolder',
            'checkShareJobStatus',
            'relinquishFolderMembership',
            'relinquishFileMembership',
            'updateSharedLinkSettings',
            'paginateUserSharedFiles',
            'getUserSharedFiles',
            'paginateUserMountableFolders',
            'getUserMountableFolders',
            'paginateUserSharedFolders',
            'paginateSharedFolderMembers',
            'getSharedFolderMembers',
            'paginateFileInvitedUsers',
            'getFilesInvitedUsers',
            'getFileInvitedUsers',
            'getSharedLinkMetadata',
            'getSharedLinkFile',
            'getSingleFolderMetadata',
            'getSharedFileMetadataBatch',
            'getSharedFileMetadata',
            'createSharedLink',
            'checkJobStatus',
            'getUserSharedFolders',
            'addFolderMembers',
            'addFileMembers',
            'deleteDoc',
            'deleteUserFromDoc',
            'paginateVisitedUsersDoc',
            'getVisitedDocUsers',
            'addUsersToDoc',
            'setDocSharingPolicy',
            'getDocSharingPolicy',
            'paginateDocs',
            'getFolderInfo',
            'paginateDocInvitedUsers',
            'getDocInvitedUsers',
            'downloadDocAsMarkdown',
            'downloadDocAsHTML',
            'getDocs',
            'marksDocAsDeleted',
            'uploadSingleFile',
            'search',
            'getSaveFileURLStatus',
            'saveFileURL',
            'restoreFileToRevision',
            'getMoveStatus',
            'moveBatch',
            'move',
            'getFileRevisions',
            'getLatestCursor',
            'paginateFolderContents',
            'getFolderContents',
            'getImageThumbnail',
            'getFileTemporaryLink',
            'getFilePreview',
            'getMetadata',
            'downloadFile',
            'getDeleteStatus',
            'deleteBatch',
            'delete',
            'createFolder',
            'saveCopyReference',
            'getCopyReference',
            'getCopyStatus',
            'copyBatch',
            'copy',
            'getMySpaceUsage',
            'getUserAccounts',
            'getMe',
            'getSingleUserAccount',
            'revokeAccessToken',
            'getAccessToken'
        ];

        foreach($routes as $file) {
            $var = '{  
                    }';
            $post_data = json_decode($var, true);

            $response = $this->runApp('POST', '/api/Dropbox/'.$file, $post_data);

            $this->assertEquals(200, $response->getStatusCode(), 'Error in '.$file.' method');
        }
    }

}
