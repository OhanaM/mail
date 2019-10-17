<?php

declare(strict_types=1);

namespace OCA\Mail\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\SimpleMigrationStep;
use OCP\Migration\IOutput;

class Version1050Date20200624101359 extends SimpleMigrationStep {

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options) {
		/** @var ISchemaWrapper $schema */
		$schema = $schemaClosure();

		$messagesTable = $schema->getTable('mail_messages');
		$messagesTable->addColumn('parent_message_id', 'string', [
			'notnull' => false,
			'length' => 1024,
		]);
		$messagesTable->addIndex(['message_id'], 'mail_message_msg_id_idx');
		$messagesTable->addIndex(['parent_message_id'], 'mail_message_prnt_msg_id_idx');

		return $schema;
	}

}
