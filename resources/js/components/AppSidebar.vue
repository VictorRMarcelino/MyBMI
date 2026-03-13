<script setup lang="ts">
import { LayoutGrid } from 'lucide-vue-next';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import bmi from "@/routes/bmi";
import type { NavItem } from '@/types';

const mainNavItems: NavItem[] = [
    {
        title: 'Body Mass Index (BMI)',
        href: bmi.index.url(),
        icon: LayoutGrid,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>
        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
