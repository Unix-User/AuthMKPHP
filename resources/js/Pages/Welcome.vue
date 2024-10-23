<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Logo from '@/Components/Logo.vue';

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});
</script>

<template>
  <Head title="Welcome" />

  <div
    class="relative flex items-top justify-center min-h-screen bg-gray-900 dark:bg-gray-100 sm:items-center sm:pt-0"
  >
    <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
      <Link
        v-if="$page.props.auth.user"
        :href="route('dashboard')"
        class="text-sm text-gray-500 dark:text-gray-700 underline"
        >Dashboard</Link
      >

      <template v-else>
        <Link
          :href="route('login')"
          class="text-sm text-gray-500 dark:text-gray-700 underline"
          >Log in</Link
        >

        <Link
          v-if="canRegister"
          :href="route('register')"
          class="ml-4 text-sm text-gray-500 dark:text-gray-700 underline"
          >Register</Link
        >
      </template>
    </div>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <Logo />
      </div>

      <div
        class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
      >
        <div class="grid grid-cols-1 md:grid-cols-2">
          <div class="p-6">
            <div class="flex items-center">
              <svg
                class="w-8 h-8 text-gray-500"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <!-- SVG path here -->
              </svg>
              <div class="ml-4 text-lg leading-7 font-semibold">
                <a href="#" class="underline text-gray-900 dark:text-white"
                  >Gestão</a
                >
              </div>
            </div>

            <div class="ml-12">
              <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                AuthMKPHP tem uma maravilhosa e completa lista de ferramentas
                para gerenciar todos os aspectos de sua estrutura de rede pra
                você que é novo ou já tem experiência anterior com Mikrotik.
              </div>
            </div>
          </div>

          <div
            class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l"
          >
            <div class="flex items-center">
              <svg
                class="w-8 h-8 text-gray-500"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <!-- SVG path here -->
              </svg>
              <div class="ml-4 text-lg leading-7 font-semibold">
                <a href="#" class="underline text-gray-900 dark:text-white"
                  >Desenvolvimento</a
                >
              </div>
            </div>

            <div class="ml-12">
              <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                AuthMKPHP foi desenvolvido usando Laravel, PHP, e JavaScript,
                possibilitando a implementação na maioria dos serviços de
                hospedagem disponiveis na web facilitando o processo de
                configuração da aplicação.
              </div>
            </div>
          </div>

          <div class="p-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
              <svg
                class="w-8 h-8 text-gray-500"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <!-- SVG path here -->
              </svg>
              <div class="ml-4 text-lg leading-7 font-semibold">
                <a href="#" class="underline text-gray-900 dark:text-white"
                  >Automatização</a
                >
              </div>
            </div>

            <div class="ml-12">
              <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                Automatize tarefas repetitivas, agende execução de
                sincronizações em multiplos dispositivos. O AuthMKPHP possui
                ferramentas para automatizar, contabilizar e sincronizar as
                informações em seu Mikrotik de forma padronizada.
              </div>
            </div>
          </div>

          <div
            class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l"
          >
            <div class="flex items-center">
              <svg
                class="w-8 h-8 text-gray-500"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <!-- SVG path here -->
              </svg>
              <div
                class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white"
              >
                Integração de Pagamentos
              </div>
            </div>

            <div class="ml-12">
              <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                AuthMKPHP já esta integrado a plataformas de pagamento como
                <a href="#" class="underline">Mercado Pago</a> e
                <a href="#" class="underline">PagSeguro</a>
                possibilitando o processamento de pagamentos recebidos e
                liberando a conexão de seus clientes automáticamente
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
        <div class="text-center text-sm text-gray-500 sm:text-left">
          <div class="flex items-center">
            <!-- Footer content -->
          </div>
        </div>

        <div
          class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0"
        >
          Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
        </div>
      </div>
    </div>
  </div>
</template>
