# Ticket Printer

Hi. This is a very small and messy project to get issues from jira printed onto a Nemonic ticket printer. Do not expect
anything from it.

The tool has only been tested in Chrome under OSX.

## Basic setup and usage

Copy `.env.exampe` to `.env` and fill in the fields `JIRA_HOST`, `JIRA_USER` and `JIRA_PASS`.

Start the server: `docker-compose up -d`

Visit `http://127.0.0.1:8000`

Now select a jira board, select a sprint and start printing!

### Print settings

When printing set the following:

Field | Value
--- | ---
Layout | Portrait
Paper size | 80 x 80 mm
Pages per sheet | 1
Margins | none
Scale | Default
Options | Background graphics on

Scale can be customized 100% too. Background graphics are important if you want to print certain images.


## Used technology

Right now the project is using Laravel because of the ease of MVC and a Jira plugin. The Front end is Vue based which also plays out nicely with Laravel. Because we are not using database or any important back end technology the project could move to 100% front end web application.

## Todo

## Future

## License

This project is currently not an open source project. Don't use or copy any of it without prior written consent. The project will probably be open sourced when it reached a publishable state.
