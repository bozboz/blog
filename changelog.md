# Bozboz Blog Package Changelog

## Version 0.3.3 (2016-02-03)
-   Remove hard-coded class in BlogPost::relatedPosts method, to allow for extended blog post classes


## Version 0.3.2 (2015-10-07)
-   A blog post URL not found will now produce a 404 response, rather than a 500


## Version 0.3.1 (2015-09-07)
-   The route that lists all BlogPosts belonging to a BlogCategory now sorts
    BlogPosts by "post_date" DESC


## Version 0.3.0 (2015-08-26)
-   Add related blog posts functionality
-   Make blog prefix URL configurable
-   Paginate blog posts
-   Return a minimal response if request is AJAX
-   Order posts by post_date, not created_at


## Version 0.2.0 (2015-05-06)
-   Add youtube_url field to BlogPost
-   Add DateTimeField to post_date attribute
-   Add DynamicSlugField
-   Updated for bozboz/admin v1.0.0


## Version 0.1.1 (2015-01-29)

-   Tie bozboz/admin dependency to ~0.4
