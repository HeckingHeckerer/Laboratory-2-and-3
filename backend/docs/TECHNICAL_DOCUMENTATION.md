# Technical Documentation

## Architecture

Laravel 12 serves a versioned JSON API. Routes are in `routes/api.php`; API controllers in `app/Http/Controllers/Api/V1`; Eloquent models map the migrations. API responses use `success` and `data` fields, with safe JSON exception responses for API routes.

## Database and API design

The schema contains roles, users, programs, students, academic terms, courses, course offerings, enrollments, and grades. An enrollment is unique per student/offering pair; one grade may exist per enrollment. Academic records eager-load enrollment, offering, course, term, and grade data.

## Security and rules

Sanctum issues Bearer tokens. Admin and Staff use management routes. Instructor routes are restricted to offerings assigned to the authenticated instructor and their enrollments’ grades. Student self-service and academic-record access are restricted to the linked student. Authentication failures return 401, authorization failures return 403, validation failures return 422, duplicate conflicts return 409, and missing resources return safe 404 JSON.

Student collections support search across identity fields, program/year/status filtering, controlled sorting, and capped pagination. Validation enforces required values, ranges, enums, and foreign keys.

## Testing and AI workflow

`phpunit.xml` uses SQLite in-memory, isolating tests from development MySQL. Tests cover authentication, errors, authorization and ownership, student queries, enrollment rules, grades, and academic records. AI assistance was used to scaffold, review, and test changes; generated work was checked against migrations/routes and the automated suite.
