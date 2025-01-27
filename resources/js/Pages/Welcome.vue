<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Logo from '@/Components/Logo.vue';
import { ref, onMounted, computed } from 'vue';

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});

const testimonials = ref([
    {
        text: '"AuthMKPHP simplificou drasticamente a gestão da minha rede Mikrotik. Recomendo!"',
        author: 'João Silva, Administrador de Rede'
    },
    {
        text: '"A segurança oferecida pelo AuthMKPHP é excepcional. Me sinto muito mais tranquilo com a minha rede."',
        author: 'Maria Pereira, Gerente de TI'
    },
    {
        text: '"A eficiência do AuthMKPHP é incrível! Economizei horas de trabalho por semana."',
        author: 'Pedro Santos, Técnico de Suporte'
    },
]);

let currentTestimonialIndex = ref(0);

const nextTestimonial = () => {
    currentTestimonialIndex.value = (currentTestimonialIndex.value + 1) % testimonials.value.length;
};

const prevTestimonial = () => {
    currentTestimonialIndex.value = (currentTestimonialIndex.value - 1 + testimonials.value.length) % testimonials.value.length;
};

const currentTestimonial = computed(() => testimonials.value[currentTestimonialIndex.value]);

onMounted(() => {
    const intervalId = setInterval(nextTestimonial, 5000); // Change testimonial every 5 seconds
});

</script>

<template>
  <Head title="AuthMKPHP: Gerencie sua Rede Mikrotik com Facilidade" />

  <div class="relative min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
    <div v-if="canLogin" class="fixed top-0 right-0 px-4 py-2 sm:px-6 sm:py-4 z-10">
      <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm text-white bg-gray-800 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-500 rounded-lg px-4 py-2 transition duration-300">Dashboard</Link>

      <template v-else>
        <Link :href="route('login')" class="text-sm text-white bg-gray-800 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-500 rounded-lg px-4 py-2 transition duration-300 mr-2">Entrar</Link>

        <Link v-if="canRegister" :href="route('register')" class="text-sm text-white bg-gray-800 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-500 rounded-lg px-4 py-2 transition duration-300">Registrar</Link>
      </template>
    </div>

    <section class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-b from-gray-800 to-gray-900 dark:from-gray-900 dark:to-gray-800">
      <div class="container mx-auto px-4 py-16 text-center">
        <Logo class="w-64 h-auto mx-auto mb-8" />
        <h1 class="text-5xl md:text-7xl font-extrabold text-white dark:text-gray-200 mb-4">Domine sua Rede Mikrotik com <span class="text-white dark:text-gray-200">AuthMKPHP</span></h1>
        <p class="text-lg md:text-xl text-gray-200 dark:text-gray-400 mb-8">Gerenciamento simplificado, controle total e máxima eficiência para sua infraestrutura de rede.  Aumente sua produtividade e segurança.</p>
        <div class="flex flex-wrap justify-center space-x-4">
          <Link :href="route('register')" class="inline-block px-10 py-4 text-xl font-medium text-center bg-white text-gray-800 hover:bg-gray-700 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 rounded-lg transition duration-300 mx-2 mb-4">Comece Já!</Link>
          <a href="#" class="inline-block px-10 py-4 text-xl font-medium text-center bg-gray-800 text-white hover:bg-gray-700 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500 rounded-lg transition duration-300 mx-2 mb-4">Saiba Mais</a>
        </div>
      </div>
    </section>

    <section class="py-12 bg-gray-50 dark:bg-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white text-center mb-8">Por que escolher o AuthMKPHP?</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex items-center mb-4">
                        <svg class="h-6 w-6 mr-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Gerenciamento Intuitivo</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Interface simples e fácil de usar, para todos os níveis de experiência.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex items-center mb-4">
                        <svg class="h-6 w-6 mr-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Segurança Incomparável</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Proteja sua rede com recursos de segurança robustos e atualizados.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex items-center mb-4">
                        <svg class="h-6 w-6 mr-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Eficiência Sem Igual</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Automatize tarefas, economize tempo e otimize seus recursos.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-8 text-center">Depoimentos</h2>
            <div class="flex items-center justify-between">
                <button @click="prevTestimonial" class="text-gray-400 hover:text-gray-600 focus:outline-none" aria-label="Previous Testimonial">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <div class="w-full">
                    <blockquote class="text-gray-600 dark:text-gray-400 italic text-lg md:text-xl p-4 text-center">
                        <p v-html="currentTestimonial.text"></p>
                        <p class="text-gray-500 dark:text-gray-500 text-sm mt-2">- {{ currentTestimonial.author }}</p>
                    </blockquote>
                </div>
                <button @click="nextTestimonial" class="text-gray-400 hover:text-gray-600 focus:outline-none" aria-label="Next Testimonial">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-50 dark:bg-gray-700">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-8 text-center">Recursos e Benefícios</h2>
            <div class="flex flex-wrap justify-center">
                <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Gerenciamento Simplificado</h3>
                        <p class="text-gray-600 dark:text-gray-400">Controle total da sua rede Mikrotik com facilidade.</p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Tecnologia Moderna</h3>
                        <p class="text-gray-600 dark:text-gray-400">Construído com Laravel, PHP e Vue.js, garantindo performance e segurança.</p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Automação Inteligente</h3>
                        <p class="text-gray-600 dark:text-gray-400">Automatize tarefas repetitivas e otimize seu tempo.</p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Aumente sua produtividade</h3>
                        <p class="text-gray-600 dark:text-gray-400">Gerencie sua rede de forma eficiente, economizando tempo e recursos.</p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Segurança Aprimorada</h3>
                        <p class="text-gray-600 dark:text-gray-400">Proteja sua infraestrutura contra ameaças com recursos avançados de segurança.</p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Controle Total</h3>
                        <p class="text-gray-600 dark:text-gray-400">Tenha visibilidade completa do seu ambiente de rede e controle total sobre seus dispositivos.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

  </div>
</template>
