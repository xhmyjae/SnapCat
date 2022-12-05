create table if not exists users
(
    id            int unsigned auto_increment
        primary key,
    name          varchar(20)               not null,
    mail          varchar(255)              not null,
    avatar        varchar(255)              not null,
    password      varchar(50)               not null,
    creation_date timestamp default (now()) not null,
    description   varchar(150)              null,
    constraint unq_email
        unique (mail),
    constraint unq_users
        unique (name)
);

create table if not exists friends
(
    id       int unsigned auto_increment
        primary key,
    user_id1 int unsigned not null,
    user_id2 int unsigned not null,
    accepted tinyint(1)   not null,
    constraint fk_friends_users
        foreign key (user_id1) references users (id),
    constraint fk_friends_users_0
        foreign key (user_id2) references users (id)
);

create table if not exists posts
(
    id            int unsigned auto_increment
        primary key,
    message       varchar(400)              not null,
    creation_date timestamp default (now()) not null,
    user_id       int unsigned              not null,
    picture       varchar(255)              null,
    emotion       int                       not null,
    constraint fk_posts_users_0
        foreign key (user_id) references users (id)
);

create table if not exists comments
(
    id            int unsigned auto_increment
        primary key,
    message       varchar(400)              not null,
    creation_date timestamp default (now()) not null,
    vote          int       default (0)     null,
    reply_id      int unsigned              null,
    post_id       int unsigned              not null,
    user_id       int unsigned              not null,
    constraint fk_comments_comments
        foreign key (reply_id) references comments (id),
    constraint fk_comments_posts
        foreign key (post_id) references posts (id),
    constraint fk_comments_users
        foreign key (user_id) references users (id)
);

create index fk_comment_users
    on comments (user_id);

create table if not exists reactions
(
    id      int unsigned auto_increment
        primary key,
    emoji   varchar(255) not null,
    post_id int unsigned not null,
    constraint fk_reactions_posts
        foreign key (post_id) references posts (id)
);

create table if not exists user_reactions
(
    reaction_id int unsigned not null,
    user_id     int unsigned not null,
    constraint fk_user_reactions_reactions
        foreign key (reaction_id) references reactions (id),
    constraint fk_user_reactions_users
        foreign key (user_id) references users (id)
);

create index fk_user_reaction_reaction
    on user_reactions (reaction_id);