#!/usr/bin/env bash

function tear_down() {
  rm -f tests/EndToEnd/Fixtures/*.fixed
}

function test_phpcs_out_of_memory_error_handling() {
  OUTPUT="$( { bin/phpcs -d memory_limit=4M --standard=tests/EndToEnd/Fixtures/endtoend.xml.dist tests/EndToEnd/Fixtures/; } 2>&1)"
  assert_exit_code 255

  assert_contains "The PHP_CodeSniffer \"phpcs\" command ran out of memory." "$OUTPUT"
  assert_contains "Either raise the \"memory_limit\" of PHP in the php.ini file or raise the memory limit at runtime" "$OUTPUT"
  assert_contains "using \"phpcs -d memory_limit=512M\" (replace 512M with the desired memory limit)." "$OUTPUT"
}

function test_phpcbf_out_of_memory_error_handling() {
  OUTPUT="$( { bin/phpcbf -d memory_limit=4M --standard=tests/EndToEnd/Fixtures/endtoend.xml.dist tests/EndToEnd/Fixtures/ --suffix=.fixed; } 2>&1)"
  assert_exit_code 255

  assert_contains "The PHP_CodeSniffer \"phpcbf\" command ran out of memory." "$OUTPUT"
  assert_contains "Either raise the \"memory_limit\" of PHP in the php.ini file or raise the memory limit at runtime" "$OUTPUT"
  assert_contains "using \"phpcbf -d memory_limit=512M\" (replace 512M with the desired memory limit)." "$OUTPUT"
}
