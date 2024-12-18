<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import Tabs from '@/Components/tabs/Tabs.vue';
import TabItem from '@/Components/tabs/TabItem.vue';
import Card from '@/Components/Elements/Card.vue';
import Mfa from '@/Components/settings/Mfa.vue';
import Vehicles from '@/Components/settings/Vehicles.vue';
import { PageProps } from '@/types/providers';
import { MFASetup } from '@/types/mfa';

type Props = PageProps & {
    hasMfa: boolean;
    mfa: null | MFASetup;
    mustVerifyEmail?: boolean;
    status?: string;
    vehicles: { data: any[] };
};

defineProps<Props>();
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header> Profile </template>

        <AuthenticatedContentLayout>
            <Tabs>
                <TabItem title="Overview">
                    <section class="space-y-6">
                        <Card>
                            <UpdateProfileInformationForm
                                :must-verify-email="mustVerifyEmail"
                                :status="status"
                                class="max-w-xl"
                            />
                        </Card>

                        <Card>
                            <DeleteUserForm class="max-w-xl" />
                        </Card>
                    </section>
                </TabItem>

                <TabItem title="Security">
                    <section class="space-y-6">
                        <Card>
                            <UpdatePasswordForm class="max-w-xl" />
                        </Card>

                        <Card>
                            <Mfa :has-mfa="hasMfa" :mfa="mfa" />
                        </Card>
                    </section>
                </TabItem>

                <TabItem title="Vehicles">
                    <Vehicles :notify="flash.message ?? undefined" :vehicles="vehicles.data" />
                </TabItem>
            </Tabs>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
