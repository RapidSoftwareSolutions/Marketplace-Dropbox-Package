[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/Dropbox/functions?utm_source=RapidAPIGitHub_DropboxFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# Dropbox Package
Dropbox
* Domain: dropbox.com
* Credentials: apiKey, apiSecret

## How to get credentials: 
0. Go to [Dropbox website](http://dropbox.com/) 
1. Log in or create a new account
2. [Register an app](https://www.dropbox.com/developers)
3. After creation your app you will see api Secret and api Key


## Dropbox.getAccessToken
Generates user access token

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Api key obtained from Dropbox
| apiSecret  | credentials| Api secret obtained from Dropbox
| redirectUri| String     | Redirect uri set for your app
| code       | String     | Code provided by user

## Dropbox.revokeAccessToken
Revokes user access tokens

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token to revoke

## Dropbox.getSingleUserAccount
Get information about a user's account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| userId     | String| ID of the user

## Dropbox.getMe
Get information about a current user's account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token

## Dropbox.getUserAccounts
Get information about a users' accounts.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| userIds    | Array | IDs of the users

## Dropbox.getMySpaceUsage
Get the space usage information for the current user's account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token

## Dropbox.copy
Copy a file or folder to a different location in the user's Dropbox. If the source path is a folder all its contents will be copied.

| Field            | Type   | Description
|------------------|--------|----------
| accessToken      | String | Access token
| fromPath         | String | Path in the user's Dropbox to be copied
| toPath           | String | Path in the user's Dropbox that is the destination.
| allowSharedFolder| Boolean| If true, copy will copy contents in shared folder, otherwise RelocationError.cant_copy_shared_folder will be returned if from_path contains shared folder. This field is always true for move. The default for this field is False.
| autoRename       | Boolean| If there's a conflict, have the Dropbox server try to autorename the file to avoid the conflict. The default for this field is False.

## Dropbox.copyBatch
Copy multiple files or folders to different locations at once in the user's Dropbox.

| Field            | Type   | Description
|------------------|--------|----------
| accessToken      | String | Access token
| entries          | Array  | List of entries to be copied. Example: [{"from_path":"/123/sample.json", "to_path": "/321/sample.json"}]
| allowSharedFolder| Boolean| If true, copy will copy contents in shared folder, otherwise RelocationError.cant_copy_shared_folder will be returned if from_path contains shared folder. This field is always true for move. The default for this field is False.
| autoRename       | Boolean| If there's a conflict, have the Dropbox server try to autorename the file to avoid the conflict. The default for this field is False.

## Dropbox.getCopyStatus
Returns the status of an asynchronous job for copyBatch. If success, it returns list of results for each entry.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| copyJobId  | String| Id of the asynchronous job. This is the value of a response returned from the method that launched the job.

## Dropbox.getCopyReference
Get a copy reference to a file or folder. 

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| path       | String| The path to the file or folder you want to get a copy reference to.

## Dropbox.saveCopyReference
Save a copy reference returned by getCopyReference to the user's Dropbox.

| Field          | Type  | Description
|----------------|-------|----------
| accessToken    | String| Access token
| destinationPath| String| Path in the user's Dropbox that is the destination.
| copyReference  | String| A copy reference returned by getCopyReference.

## Dropbox.createFolder
Create a folder at a given path.

| Field      | Type   | Description
|------------|--------|----------
| accessToken| String | Access token
| folderPath | String | Path in the user's Dropbox to create.
| autoRename | Boolean| If there's a conflict, have the Dropbox server try to autorename the folder to avoid the conflict. The default for this field is False.

## Dropbox.delete
Deletes a folder or a file at a given path.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| deletePath | String| Path in the user's Dropbox to delete.

## Dropbox.deleteBatch
Delete multiple files/folders at once.

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Access token
| deleteEntries| Array | list of entries to delete. Exmaple: [{"path":"/125"}, {"path":"/126"}]

## Dropbox.getDeleteStatus
Returns the status of an asynchronous job for deleteBatch. If success, it returns list of results for each entry.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| deleteJobId| String|  Id of the asynchronous job. This is the value of a response returned from the method that launched the job.

## Dropbox.downloadFile
Download a file from a user's Dropbox.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| filePath   | String| Path of the file

## Dropbox.getMetadata
Returns the metadata for a file or folder.

| Field                          | Type   | Description
|--------------------------------|--------|----------
| accessToken                    | String | Access token
| path                           | String | Path of the file or a folder
| includeMediaInfo               | Boolean| If true, FileMetadata.media_info is set for photo and video. The default for this field is False.
| includeDeleted                 | Boolean|  If true, DeletedMetadata will be returned for deleted file or folder, otherwise LookupError.not_found will be returned. The default for this field is False.
| includeHasExplicitSharedMembers| Boolean| If true, the results will include a flag for each file indicating whether or not that file has any explicit members. The default for this field is False.

## Dropbox.getFilePreview
Get a preview for a file. Currently previews are only generated for the files with the following extensions: .doc, .docx, .docm, .ppt, .pps, .ppsx, .ppsm, .pptx, .pptm, .xls, .xlsx, .xlsm, .rtf.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| filePath   | String| Path of the file

## Dropbox.getFileTemporaryLink
Get a temporary link to stream content of a file. This link will expire in four hours and afterwards you will get 410 Gone. Content-Type of the link is determined automatically by the file's mime type.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| filePath   | String| Path of the file

## Dropbox.getImageThumbnail
This method currently supports files with the following file extensions: jpg, jpeg, png, tiff, tif, gif and bmp. Photos that are larger than 20MB in size won't be converted to a thumbnail.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| imagePath  | String| Path of the image
| format     | String| The format for the thumbnail image, jpeg (default) or png. For images that are photos, jpeg should be preferred, while png is better for screenshots and digital arts. The default for this union is jpeg.
| size       | String| The size for the thumbnail image. The default for this union is w64h64.

## Dropbox.getFolderContents
Starts returning the contents of a folder.

| Field                          | Type   | Description
|--------------------------------|--------|----------
| accessToken                    | String | Access token
| folderP                        | String | Path of the file or a folder
| recursive                      | Boolean| If true, the list folder operation will be applied recursively to all subfolders and the response will contain contents of all subfolders. The default for this field is False.
| includeMediaInfo               | Boolean| If true, FileMetadata.media_info is set for photo and video. The default for this field is False.
| includeDeleted                 | Boolean|  If true, DeletedMetadata will be returned for deleted file or folder, otherwise LookupError.not_found will be returned. The default for this field is False.
| includeHasExplicitSharedMembers| Boolean| If true, the results will include a flag for each file indicating whether or not that file has any explicit members. The default for this field is False.

## Dropbox.paginateFolderContents
Once a cursor has been retrieved from getFolderContents, use this to paginate through all files and retrieve updates to the folder, following the same rules as documented for getFolderContents.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| cursor     | String| The cursor returned by your last call to getFolderContents or paginateFolderContents

## Dropbox.getLatestCursor
A way to quickly get a cursor for the folder's state.

| Field                          | Type   | Description
|--------------------------------|--------|----------
| accessToken                    | String | Access token
| folderPath                     | String | Path of the file or a folder
| recursive                      | Boolean| If true, the list folder operation will be applied recursively to all subfolders and the response will contain contents of all subfolders. The default for this field is False.
| includeMediaInfo               | Boolean| If true, FileMetadata.media_info is set for photo and video. The default for this field is False.
| includeDeleted                 | Boolean|  If true, DeletedMetadata will be returned for deleted file or folder, otherwise LookupError.not_found will be returned. The default for this field is False.
| includeHasExplicitSharedMembers| Boolean| If true, the results will include a flag for each file indicating whether or not that file has any explicit members. The default for this field is False.

## Dropbox.getFileRevisions
Return revisions of a file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| filePath   | String| Path of the file
| limit      | Number| The maximum number of revision entries returned. The default for this field is 10.

## Dropbox.move
Move a file or folder to a different location in the user's Dropbox. If the source path is a folder all its contents will be moved.

| Field      | Type   | Description
|------------|--------|----------
| accessToken| String | Access token
| fromPath   | String | Path in the user's Dropbox to be moved
| toPath     | String | Path in the user's Dropbox that is the destination.
| autoRename | Boolean| If there's a conflict, have the Dropbox server try to autorename the file to avoid the conflict. The default for this field is False.

## Dropbox.moveBatch
Move multiple files or folders to different locations at once in the user's Dropbox.

| Field      | Type   | Description
|------------|--------|----------
| accessToken| String | Access token
| entries    | Array  | List of entries to be moved. Example: [{"from_path":"/123/sample.json", "to_path": "/321/sample.json"}]
| autoRename | Boolean| If there's a conflict, have the Dropbox server try to autorename the file to avoid the conflict. The default for this field is False.

## Dropbox.getMoveStatus
Returns the status of an asynchronous job for moveBatch. If success, it returns list of results for each entry.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| moveJobId  | String|  Id of the asynchronous job. This is the value of a response returned from the method that launched the job.

## Dropbox.restoreFileToRevision
Restore a file to a specific revision.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| filePath   | String| Path of the file in the user's Dropbox to restore.
| revisionId | String| Id of the revision

## Dropbox.saveFileURL
Save a specified URL into a file in user's Dropbox. If the given path already exists, the file will be renamed to avoid the conflict (e.g. myfile (1).txt).

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| filePath   | String| Path of the file in the user's Dropbox to restore.
| url        | String| The URL to be saved.

## Dropbox.getSaveFileURLStatus
Returns the status of an asynchronous job for saveFileURL. If success, it returns list of results for each entry.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token
| saveUrlJobId| String| Id of the asynchronous job. This is the value of a response returned from the method that launched the job.

## Dropbox.search
Searches for files and folders.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| searchPath | String| The path in the user's Dropbox to search. Should probably be a folder.
| searchQuery| String| The string to search for. The search string is split on spaces into multiple tokens. For file name searching, the last token is used for prefix matching (i.e. "bat c" matches "bat cave" but not "batman car").
| startFrom  | Number| The starting index within the search results (used for paging). The default for this field is 0.
| maxResults | Number| The maximum number of search results to return. The default for this field is 100.
| searchMode | String| The search mode (filename, filename_and_content, or deleted_filename). Note that searching file content is only available for Dropbox Business accounts. The default for this union is filename.

## Dropbox.uploadSingleFile
Create a new file with the contents provided in the request.

| Field         | Type   | Description
|---------------|--------|----------
| accessToken   | String | Access token
| filePath      | String | Path in the user's Dropbox to save the file.
| file          | File   | The file to upload
| uploadMode    | String | Selects what to do if the file already exists. The default for this union is add.
| autoRename    | Boolean| If there's a conflict, as determined by mode, have the Dropbox server try to autorename the file to avoid conflict. The default for this field is False.
| clientModified| String | Timestamp(format="%Y-%m-%dT%H:%M:%SZ") The value to store as the client_modified timestamp. 
| mute          | Boolean| Normally, users are made aware of any file modifications in their Dropbox account via notifications in the client software. If true, this tells the clients that this modification shouldn't result in a user notification. The default for this field is False.

## Dropbox.marksDocAsDeleted
Marks the given Paper doc as deleted. This operation is non-destructive and the doc can be revived by the owner.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| documentId | String| Id of the document

## Dropbox.getDocs
Return the list of all Paper docs according to the argument specifications.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| filterBy   | String| Allows user to specify how the Paper docs should be filtered. Possible values: docs_accessed(default), docs_created
| sortBy     | String| Allows user to specify how the Paper docs should be sorted. Possible values: accessed(default), modified, created
| sortOrder  | String| Allows user to specify the sort order of the result. Possible values: ascending(default), descending
| limit      | Number| Size limit per batch. The maximum number of docs that can be retrieved per batch is 1000. Higher value results in invalid arguments error. The default for this field is 1000.

## Dropbox.downloadDocAsHTML
Exports and downloads Paper doc either as HTML.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| documentId | String| Id of the document

## Dropbox.downloadDocAsMarkdown
Exports and downloads Paper doc either as Markdown.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| documentId | String| Id of the document

## Dropbox.getDocInvitedUsers
Lists the users who are explicitly invited to the Paper folder in which the Paper doc is contained. For private folders all users (including owner) shared on the folder are listed and for team folders all non-team users shared on the folder are returned.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| documentId | String| Id of the document
| limit      | Number| Size limit per batch. The maximum number of users that can be retrieved per batch is 1000. Higher value results in invalid arguments error. The default for this field is 1000.

## Dropbox.paginateDocInvitedUsers
Once a cursor has been retrieved from getDocInvitedUsers, use this to paginate through all users on the Paper folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| documentId | String| Id of the document
| cursor     | String| he cursor obtained from getDocInvitedUsers

## Dropbox.getFolderInfo
Retrieves folder information for the given Paper doc.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| documentId | String| Id of the document

## Dropbox.paginateDocs
Once a cursor has been retrieved from getDocs, use this to paginate through all Paper doc.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| cursor     | String| The cursor obtained from getDocs

## Dropbox.getDocSharingPolicy
Gets the default sharing policy for the given Paper doc.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| documentId | String| Id of the document

## Dropbox.setDocSharingPolicy
Sets the default sharing policy for the given Paper doc.

| Field              | Type  | Description
|--------------------|-------|----------
| accessToken        | String| Access token
| documentId         | String| Id of the document
| publicSharingPolicy| String| This value applies to the non-team members. Possible values: people_with_link_can_edit, people_with_link_can_view_and_comment, invite_only, disabled
| teamSharingPolicy  | String| This value applies to the team members. Possible values: people_with_link_can_edit, people_with_link_can_view_and_comment, invite_only

## Dropbox.addUsersToDoc
Allows an owner or editor to add users to a Paper doc or change their permissions using their email or Dropbox account id.

| Field        | Type   | Description
|--------------|--------|----------
| accessToken  | String | Access token
| documentId   | String | Id of the document
| membersList  | Array  | Users which should be added to the Paper doc. Specify only email or Dropbox account id. Example: [{"member": {".tag": "email","email": "justin@example.com"},"permission_level":{".tag":"view_and_comment"}}]
| customMessage| String | A personal message that will be emailed to each successfully added member.
| quiet        | Boolean| Clients should set this to true if no email shall be sent to added users. The default for this field is False.

## Dropbox.getVisitedDocUsers
Lists all users who visited the Paper doc or users with explicit access. This call excludes users who have been removed. 

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| documentId | String| Id of the document
| limit      | Number| Size limit per batch. The maximum number of users that can be retrieved per batch is 1000. Higher value results in invalid arguments error. The default for this field is 1000.
| filterBy   | String|  Specify this attribute if you want to obtain users that have already accessed the Paper doc. Possible values: shared(default), visited

## Dropbox.paginateVisitedUsersDoc
Once a cursor has been retrieved from getVisitedDocUsers, use this to paginate through all users on the Paper doc.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| documentId | String| Id of the document
| cursor     | String|  The cursor obtained from getVisitedDocUsers

## Dropbox.deleteUserFromDoc
Allows an owner or editor to remove users from a Paper doc using their email or Dropbox account id.

| Field           | Type  | Description
|-----------------|-------|----------
| accessToken     | String| Access token
| documentId      | String| Id of the document
| memberTag       | String| Includes different ways to identify a member of a shared folder. This datatype comes from an imported namespace originally defined in the sharing namespace. The value will be one of the following datatypes. New values may be introduced as our API evolves. Possible values: email, dropbox_id
| memberIdentifier| String| Id of the user or email

## Dropbox.deleteDoc
Permanently deletes the given Paper doc. This operation is final as the doc cannot be recovered.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| documentId | String| Id of the document

## Dropbox.addFileMembers
Adds specified members to a file.

| Field              | Type   | Description
|--------------------|--------|----------
| accessToken        | String | Access token
| fileId             | String | Id of the file
| membersList        | Array  | Users which should be added to the Paper doc. Specify only email or Dropbox account id. Example: [{".tag": "email","email": "justin@example.com"}]
| customMessage      | String | A personal message that will be emailed to each successfully added member.
| quiet              | Boolean| Clients should set this to true if no email shall be sent to added users. The default for this field is False.
| addMessageAsComment| Boolean| If the custom message should be added as a comment on the file. The default for this field is False.
| accessLevel        | String | AccessLevel union object, describing what access level we want to give new members. Possible values: viewer(default), owner, editor, viewer_no_comment.

## Dropbox.addFolderMembers
Adds specified members to a folder.

| Field        | Type   | Description
|--------------|--------|----------
| accessToken  | String | Access token
| folderId     | String | Id of the folder
| membersList  | Array  | Users which should be added to the Paper doc. Specify only email or Dropbox account id. Example: [{"member" :{".tag": "email","email": "justin@example.com"}}]
| customMessage| String | A personal message that will be emailed to each successfully added member.
| quiet        | Boolean| Clients should set this to true if no email shall be sent to added users. The default for this field is False.

## Dropbox.getUserSharedFolders
Return the list of all shared folders the current user has access to.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| limit      | Number| The maximum number of results to return per request. The default for this field is 1000.
| actionsList| String|  A list of `FolderAction`s corresponding to `FolderPermission`s that should appear in the response's SharedFolderMetadata.permissions field describing the actions the authenticated user can perform on the folder.

## Dropbox.checkJobStatus
Returns the status of an asynchronous job.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| jobId      | String| Id of the asynchronous job. This is the value of a response returned from the method that launched the job

## Dropbox.createSharedLink
Create a shared link with custom settings. 

| Field              | Type  | Description
|--------------------|-------|----------
| accessToken        | String| Access token
| linkPath           | String| The path to be shared by the shared link
| requestedVisibility| String| The requested access for this shared link. Possible values: public, team_only

## Dropbox.getSharedFileMetadata
Returns shared file metadata.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| fileId     | String|  The file to query.
| options    | Array | A list of `FileAction`s corresponding to `FilePermission`s that should appear in the response's SharedFileMetadata.permissions field describing the actions the authenticated user can perform on the file.

## Dropbox.getSharedFileMetadataBatch
Returns shared file metadata.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| fileIds    | Array |  Files to query.
| options    | Array | A list of `FileAction`s corresponding to `FilePermission`s that should appear in the response's SharedFileMetadata.permissions field describing the actions the authenticated user can perform on the file.

## Dropbox.getSingleFolderMetadata
Returns shared folder metadata by its folder ID.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| folderId   | String| The ID for the shared folder.
| options    | Array |  A list of `FolderAction`s corresponding to `FolderPermission`s that should appear in the response's SharedFolderMetadata.permissions field describing the actions the authenticated user can perform on the folder.

## Dropbox.getSharedLinkFile
Download the shared link's file from a user's Dropbox.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token
| linkUrl     | String| URL of the shared link.
| path        | String| If the shared link is to a folder, this parameter can be used to retrieve the metadata for a specific file or sub-folder in this folder. A relative path should be used.
| linkPassword| String| If the shared link has a password, this parameter can be used. 

## Dropbox.getSharedLinkMetadata
Get the shared link's metadata.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token
| linkUrl     | String| URL of the shared link.
| path        | String|  If the shared link is to a folder, this parameter can be used to retrieve the metadata for a specific file or sub-folder in this folder. A relative path should be used. 
| linkPassword| String| If the shared link has a password, this parameter can be used. 

## Dropbox.getFileInvitedUsers
Use to obtain the members who have been invited to a file, both inherited and uninherited members.

| Field           | Type   | Description
|-----------------|--------|----------
| accessToken     | String | Access token
| fileId          | String | The file for which you want to see members.
| limit           | Number | Number of members to return max per query. Defaults to 100 if no limit is specified. The default for this field is 100.
| actions         | Array  | The actions for which to return permissions on a member.
| includeInherited| Boolean| Whether to include members who only have access from a parent shared folder. The default for this field is True.

## Dropbox.getFilesInvitedUsers
Get members of multiple files at once. The arguments to this route are more limited, and the limit on query result size per file is more strict. 

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| fileIds    | Array | Files for which you want to see members.
| limit      | Number| Number of members to return max per query. Defaults to 10 if no limit is specified.

## Dropbox.paginateFileInvitedUsers
Once a cursor has been retrieved from getFileInvitedUsers or getFilesInvitedUsers, use this to paginate through all shared file members.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| cursor     | String| The cursor returned by your last call

## Dropbox.getSharedFolderMembers
Returns shared folder membership by its folder ID.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| folderId   | String| The folder for which you want to see members.
| limit      | Number| Number of members to return max per query. The default for this field is 1000.
| actions    | Array | The actions for which to return permissions on a member.

## Dropbox.paginateSharedFolderMembers
Once a cursor has been retrieved from getSharedFolderMembers, use this to paginate through all shared folder members.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| cursor     | String| The cursor returned by your last call

## Dropbox.paginateUserSharedFolders
Once a cursor has been retrieved from getUserSharedFolders, use this to paginate through all shared folders.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| cursor     | String| The cursor returned by your last call

## Dropbox.getUserMountableFolders
Return the list of all shared folders the current user can mount or unmount.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| limit      | Number| Number of members to return max per query. The default for this field is 1000.
| actions    | Array | A list of `FolderAction`s corresponding to `FolderPermission`s that should appear in the response's SharedFolderMetadata.permissions field describing the actions the authenticated user can perform on the folder.

## Dropbox.paginateUserMountableFolders
Once a cursor has been retrieved from getUserMountableFolders, use this to paginate through all mountable folders.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| cursor     | String| The cursor returned by your last call

## Dropbox.getUserSharedFiles
Returns a list of all files shared with current user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| limit      | Number| Number of members to return max per query. The default for this field is 100.
| actions    | Array | A list of `FileAction`s corresponding to `FilePermission`s that should appear in the response's SharedFileMetadata.permissions field describing the actions the authenticated user can perform on the file.

## Dropbox.paginateUserSharedFiles
Get more results with a cursor from getUserSharedFiles

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| cursor     | String| The cursor returned by your last call

## Dropbox.updateSharedLinkSettings
Create a shared link with custom settings. 

| Field              | Type  | Description
|--------------------|-------|----------
| accessToken        | String| Access token
| linkUrl            | String| URL of the shared link to change its settings
| requestedVisibility| String| The requested access for this shared link. Possible values: public, team_only

## Dropbox.relinquishFileMembership
The current user relinquishes their membership in the designated file. Note that the current user may still have inherited access to this file through the parent folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| fileId     | String| ID of the file

## Dropbox.relinquishFolderMembership
The current user relinquishes their membership in the designated folder.

| Field      | Type   | Description
|------------|--------|----------
| accessToken| String | Access token
| folderId   | String | ID of the folder
| leaveCopy  | Boolean| Keep a copy of the folder's contents upon relinquishing membership. The default for this field is False.

## Dropbox.shareFolder
Share a folder with collaborators.

| Field           | Type   | Description
|-----------------|--------|----------
| accessToken     | String | Access token
| folderPath      | String | The path to the folder to share. If it does not exist, then a new one is created.
| memberPolicy    | String | Who can be a member of this shared folder. Only applicable if the current user is on a team. Possible values: team, anyone
| aclUpdatePolicy | String | Who can add and remove members of this shared folder.  Possible values: owner, editors
| sharedLinkPolicy| String | The policy to apply to shared links created for content inside this shared folder. The current user must be on a team to set this policy to SharedLinkPolicy.members. Possible values: anyone, team, members
| forceAsync      | Boolean| Whether to force the share to happen asynchronously. The default for this field is False.
| actions         | Array  | A list of `FolderAction`s corresponding to `FolderPermission`s that should appear in the response's SharedFolderMetadata.permissions field describing the actions the authenticated user can perform on the folder.
| accessLevel     | String | The access level on the link for this file. Currently, it only accepts 'viewer' and 'viewer_no_comment'.
| linkAudience    | String | The type of audience on the link for this file. Possible values: public, team, members
| linkExpiry      | JSON   | An expiry timestamp to set on a link. Possible values: remove_expiry, set_expiry Timestamp(format="%Y-%m-%dT%H:%M:%SZ") Set a new expiry or change an existing expiry.
| linkPassword    | JSON   | The password for the link. Possible values: remove_password, set_password
| viewerInfoPolicy| String | Who can enable/disable viewer info for this shared folder.Possible values: enabled, disabled

## Dropbox.checkShareJobStatus
Returns the status of an asynchronous job for sharing a folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| shareJobId | String| ID of the share job

## Dropbox.unshareFolder
Allows a shared folder owner to unshare the folder.

| Field      | Type   | Description
|------------|--------|----------
| accessToken| String | Access token
| folderId   | String | ID of the folder
| leaveCopy  | Boolean| Keep a copy of the folder's contents upon relinquishing membership. The default for this field is False.

## Dropbox.unshareFile
Remove all members from this file. Does not remove inherited members.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| fileId     | String| ID of the file

## Dropbox.mountFolder
The current user mounts the designated folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| folderId   | String| ID of the folder

## Dropbox.unmountFolder
The current user unmounts the designated folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| folderId   | String| ID of the folder

## Dropbox.revokeSharedLink
Revoke a shared link.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| linkUrl    | String| URL of the shared link.

## Dropbox.removeFileMember
Removes a specified member from the file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| fileId     | String| Id of the file
| member     | JSON  |  Member to remove from this file. Note that even if an email is specified, it may result in the removal of a user (not an invitee) if the user's main account corresponds to that email address. Example: {".tag": "email","email": "justin@example.com"}

## Dropbox.removeFolderMember
Removes a specified member from the folder.

| Field      | Type   | Description
|------------|--------|----------
| accessToken| String | Access token
| folderId   | String | Id of the file
| member     | JSON   |  Member to remove from this file. Note that even if an email is specified, it may result in the removal of a user (not an invitee) if the user's main account corresponds to that email address. Example: {".tag": "email","email": "justin@example.com"}
| leaveCopy  | Boolean| If true, the removed user will keep their copy of the folder after it's unshared, assuming it was mounted. Otherwise, it will be removed from their Dropbox. Also, this must be set to false when kicking a group.

## Dropbox.checkRemoveMemberStatus
Returns the status of an asynchronous job.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| removeJobId| String| Id of the asynchronous job. This is the value of a response returned from the method that launched the job

## Dropbox.transferFolderOwnership
Transfer ownership of a shared folder to a member of the shared folder.User must have AccessLevel.owner access to the shared folder to perform a transfer.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| folderId   | String| ID of the folder
| userId     | String| ID of the user

## Dropbox.updateFileMemberAccess
Changes a member's access on a shared file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| fileId     | String| Id of the file
| memberId   | String| Dropbox ID of the user
| accessLevel| String| Defines the access levels for collaborators. Currently only available: viewer

## Dropbox.updateFolderMemberAccess
Changes a member's access on a shared folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token
| folderId   | String| Id of the folder
| member     | JSON  | Member to remove from this file. Note that even if an email is specified, it may result in the removal of a user (not an invitee) if the user's main account corresponds to that email address. Example: {".tag": "email","email": "justin@example.com"}
| accessLevel| String| Defines the access levels for collaborators. Currently only available: viewer, editor

## Dropbox.updateFolderPolicy
Update the sharing policies for a shared folder.

| Field           | Type   | Description
|-----------------|--------|----------
| accessToken     | String | Access token
| folderId        | String | The ID of the folder
| memberPolicy    | String | Who can be a member of this shared folder. Only applicable if the current user is on a team. Possible values: team, anyone
| aclUpdatePolicy | String | Who can add and remove members of this shared folder.  Possible values: owner, editors
| sharedLinkPolicy| String | The policy to apply to shared links created for content inside this shared folder. The current user must be on a team to set this policy to SharedLinkPolicy.members. Possible values: anyone, team, members
| forceAsync      | Boolean| Whether to force the share to happen asynchronously. The default for this field is False.
| actions         | Array  | A list of `FolderAction`s corresponding to `FolderPermission`s that should appear in the response's SharedFolderMetadata.permissions field describing the actions the authenticated user can perform on the folder.
| accessLevel     | String | The access level on the link for this file. Currently, it only accepts 'viewer' and 'viewer_no_comment'.
| linkAudience    | String | The type of audience on the link for this file. Possible values: public, team, members
| linkExpiry      | JSON   | An expiry timestamp to set on a link. Possible values: remove_expiry, set_expiry Timestamp(format="%Y-%m-%dT%H:%M:%SZ") Set a new expiry or change an existing expiry.
| linkPassword    | JSON   | The password for the link. Possible values: remove_password, set_password
| viewerInfoPolicy| String | Who can enable/disable viewer info for this shared folder.Possible values: enabled, disabled

