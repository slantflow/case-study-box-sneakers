# BOX Sneakers — AI Customer Support Assistant

**Engineering case study | Ecommerce · AI Customer Support · Human Handoff**

## Business context
BOX Sneakers operates a WooCommerce storefront with customer conversations about products, orders and shipping. SlantFlow's broader ecommerce work covers storefront customization, shipping/logistics integrations, order workflows, and operations infrastructure.

## AI assistant work
The assistant project focuses on using verified store information to support customer questions and on managing sensitive cases through human handoff. Order-specific responses require authorized live integration rather than generated guesses.

### Solution approach
- Conversational interface for natural customer questions
- Store-specific approved knowledge distinct from order/customer records
- Authorized integration layer for any live order status or product data
- Human takeover when the request needs staff involvement
- Event logging, safe retry and operational supervision as appropriate to the deployed components

## Important scope boundaries
This describes relevant project and integration work, **not a claim that every capability is deployed and active today**. Current status of image understanding, voice handling, autonomous follow-ups, booking, order actions and model routing should be verified against the actual production release before publication as completed features.

No response-rate, conversion, cost-saving or other performance figures are claimed without measured evidence. This document includes no private chat messages, customer data, credentials, code or infrastructure addresses.

## Technologies and disciplines
WooCommerce · PHP · Python · API integrations · AI conversation design · Human handoff

## Related work
- [BOX Sneakers — Commerce case study](./README.md)
- [SlantFlow website](https://slantflow.com/)

*Public summary of engineering work; proprietary source code is not included.*
