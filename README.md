Bitbucket Webhook
=================

[![Build Status](https://travis-ci.org/kanboard/plugin-bitbucket-webhook.svg?branch=master)](https://travis-ci.org/kanboard/plugin-bitbucket-webhook)

Bind Bitbucket webhook events to Kanboard automatic actions.

Author
------

- Frederic Guillot
- License MIT

Requirements
------------

- Kanboard >= 1.0.29
- Bitbucket webhooks configured for a project

Installation
------------

You have the choice between 3 methods:

1. Install the plugin from the Kanboard plugin manager with one click
2. Download the zip file and decompress everything under the directory `plugins/BitbucketWebhook`
3. Clone this repository into the folder `plugins/BitbucketWebhook`

Note: Plugin folder is case-sensitive.

Documentation
-------------

### List of supported events

- Bitbucket commit received
- Bitbucket issue opened
- Bitbucket issue closed
- Bitbucket issue reopened
- Bitbucket issue assignee change
- Bitbucket issue comment created

### List of supported actions

- Create a task from an external provider
- Change the assignee based on an external username
- Create a comment from an external provider
- Close a task
- Open a task

### Configuration

![Bitbucket configuration](https://cloud.githubusercontent.com/assets/323546/20451760/4441dee4-adcb-11e6-9f66-0987294cc5d7.png)

1. On Kanboard, go to the project settings and choose the section **Integrations**
2. Copy the Bitbucket webhook URL
3. On Bitbucket, go to the project settings and go to the section **Webhooks**
4. Choose a title for your webhook and paste the Kanboard URL

### Examples

You have to create some automatic actions in your project to make it work:

#### Close a Kanboard task when a commit pushed to Bitbucket

- Choose the event: **Bitbucket commit received**
- Choose action: **Close the task**

When one or more commits are sent to Bitbucket, Kanboard will receive the information, each commit message with a task number included will be closed.

Example:

- Commit message: "Fix bug #1234"
- That will close the Kanboard task #1234

#### Add comment when a commit received

- Choose the event: **Bitbucket commit received**
- Choose action: **Create a comment from an external provider**

The comment will contain the commit message and the URL to the commit.
