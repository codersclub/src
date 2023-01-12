# acl.auth.php
# <?php exit()?>
# Don't modify the lines above
#
# Access Control Lists
#
# Editing this file by hand shouldn't be necessary. Use the ACL
# Manager interface instead.
#
# If your auth backend allows special char like spaces in groups
# or user names you need to urlencode them (only chars <128, leave
# UTF-8 multibyte chars as is)
#
# none   0
# read   1
# edit   2
# create 4
# upload 8

#*               @ALL        4
*   @ALL   1
*   @user   4
*   @devel	8
#*   @admin   255
site:*	@ALL	0
site:*	@devel	0
site:*	@user	0
