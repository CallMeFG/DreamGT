Pembagian tugas:
1. halaman public (home, competitions, schedule, gallery, layouts, partials -> rizky,
                 arena & PCs -> nazlan & emil,
                 about, contact) -> tommy

2. auth (login, regis, socialite, middleware)-> rizky

3. database (erd-> tommy ,
    migrate, model, seeder, env)-> rizky

4. user(dashboard, setting, crud arena & pc) ->tommy (dibantu rizky)

5. staff pc (dashboard, manage pc, transation) -> nazlan (dibantu rizky)

6. staff arena (dashboard, manage arena, transation) ->emil (dibantu rizky)

7. admin (dashboard, manage pc, manage arena, transaction, calendar, users) -> rizky


<!-- -----------------test------------------- -->
graph TD
    A[Game Central V3] --> B(Public Access)
    A --> C(Authentication)
    A --> D(Role Management)
    A --> E(Database)

    B --> B1[Home, Layouts, Gallery - <b>Rizky</b>]
    B --> B2[Arena & PC List - <b>Nazlan & Emil</b>]
    B --> B3[About, Contact - <b>Tommy</b>]

    C --> C1[Login, Register, Socialite - <b>Rizky</b>]

    D --> D1[Admin Dashboard & Logic - <b>Rizky</b>]
    D --> D2[Member Dashboard - <b>Tommy</b> w/ Rizky]
    D --> D3[Staff PC Dashboard - <b>Nazlan</b> w/ Rizky]
    D --> D4[Staff Arena Dashboard - <b>Emil</b> w/ Rizky]

    E --> E1[ERD Design - <b>Tommy</b>]
    E --> E2[Migration & Seeding - <b>Rizky</b>]