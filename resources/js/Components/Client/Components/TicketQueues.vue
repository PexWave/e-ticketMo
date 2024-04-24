<template>
    <v-table density="compact">
      <thead>
        <tr>
          <th class="text-left">
            Queue #
          </th>
          <th class="text-left">
            Ticket #
          </th>
          <th class="text-left">
            Client Type
          </th>
          <th class="text-left">
            Extension Request
          </th>
          <th class="text-left">
            Transfer Request
          </th>
          <th class="text-left">
            Status
          </th>
          <th class="text-left">
            Action
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="item in desserts"
          :key="item.name"
        >
          <td>{{ item.name }}</td>
          <td>{{ item.calories }}</td>
        </tr>
      </tbody>
    </v-table>
  </template>
  <script>
    export default {
      data () {
        return {
          desserts: [
            {
              name: 'Frozen Yogurt',
              calories: 159,
            },
            {
              name: 'Ice cream sandwich',
              calories: 237,
            },
            {
              name: 'Eclair',
              calories: 262,
            },
            {
              name: 'Cupcake',
              calories: 305,
            },
            {
              name: 'Gingerbread',
              calories: 356,
            },
            {
              name: 'Jelly bean',
              calories: 375,
            },
            {
              name: 'Lollipop',
              calories: 392,
            },
            {
              name: 'Honeycomb',
              calories: 408,
            },
            {
              name: 'Donut',
              calories: 452,
            },
            {
              name: 'KitKat',
              calories: 518,
            },
          ],
        }
      },
    }
  </script>