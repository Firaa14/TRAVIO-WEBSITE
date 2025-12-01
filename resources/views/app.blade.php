<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia>{{ config('app.name', 'Travio') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Simple Inertia Setup --}}
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/@inertiajs/vue3"></script>

    <script>
        const { createApp, h } = Vue;
        const { createInertiaApp } = InertiaVue3;

        createInertiaApp({
            resolve: async name => {
                // Define basic auth components inline
                const authComponents = {
                    'auth/Login': {
                        template: `
                            <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
                                <div class="max-w-md w-full space-y-8">
                                    <div>
                                        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                                            Sign in to your account
                                        </h2>
                                    </div>
                                    <form class="mt-8 space-y-6" @submit.prevent="submit">
                                        <div class="rounded-md shadow-sm -space-y-px">
                                            <div>
                                                <input v-model="form.email" type="email" required
                                                    class="relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                                    placeholder="Email address">
                                            </div>
                                            <div>
                                                <input v-model="form.password" type="password" required
                                                    class="relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                                    placeholder="Password">
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit"
                                                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Sign in
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        `,
                        data() {
                            return {
                                form: {
                                    email: '',
                                    password: '',
                                    remember: false
                                }
                            }
                        },
                        methods: {
                            submit() {
                                this.$inertia.post('/login', this.form);
                            }
                        }
                    },
                    'auth/Register': {
                        template: `
                            <div class="min-h-screen flex items-center justify-center bg-gray-50">
                                <div class="max-w-md w-full space-y-8">
                                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Register</h2>
                                    <form @submit.prevent="submit" class="space-y-6">
                                        <input v-model="form.name" type="text" placeholder="Name" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                        <input v-model="form.email" type="email" placeholder="Email" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                        <input v-model="form.password" type="password" placeholder="Password" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                        <input v-model="form.password_confirmation" type="password" placeholder="Confirm Password" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md">Register</button>
                                    </form>
                                </div>
                            </div>
                        `,
                        data() {
                            return {
                                form: {
                                    name: '',
                                    email: '',
                                    password: '',
                                    password_confirmation: ''
                                }
                            }
                        },
                        methods: {
                            submit() {
                                this.$inertia.post('/register', this.form);
                            }
                        }
                    }
                };

                return authComponents[name] || {
                    template: `<div class="p-8 text-center">
                        <h1 class="text-2xl font-bold">Component: {{ name }}</h1>
                        <p>Please create this component</p>
                    </div>`,
                    props: ['name'],
                    data() { return { name } }
                };
            },
            setup({ el, App, props, plugin }) {
                createApp({ render: () => h(App, props) })
                    .use(plugin)
                    .mount(el);
            },
        });
    </script>
</body>

</html>