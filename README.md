# Opinion-Poll-App
A Sample Opinion Polling Application created using PHP and MySql.

DB Design:

TABLE: POLLS

``CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `user_selection` tinyint(1) NOT NULL,
  `total_count` int(11) NOT NULL,
  `submit_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;``

TABLE : POLL CHOICES

``CREATE TABLE IF NOT EXISTS `poll_choices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(55) NOT NULL,
  `choice_id` tinyint(1) NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;``

TABLE : POLL QUESTIONS

``CREATE TABLE IF NOT EXISTS `poll_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;``
