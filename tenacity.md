classDiagram
direction BT
class branches
class cards
class clients
class companies
class failed_jobs
class groups
class migrations
class password_reset_tokens
class personal_access_tokens
class team_user
class teams
class users

branches  -->  teams : team_id:id
cards  -->  groups : group_id:id
cards  -->  teams : team_id:id
clients  -->  teams : team_id:id
companies  -->  teams : team_id:id
groups  -->  companies : company_id:id
team_user  -->  teams : team_id:id
team_user  -->  users : user_id:id
